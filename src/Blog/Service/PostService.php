<?php
/**
 * Blog
 * 
 * A blog module.
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *  
 * @author Juan Pedro Gonzalez Gutierrez
 * @copyright Copyright (c) 2013 Juan Pedro Gonzalez Gutierrez (http://www.jpg-consulting.com)
 * @license http://www.gnu.org/licenses/gpl-2.0.html GPLv2 License
 */
namespace Blog\Service;

use Zend\ServiceManager\ServiceManager;

use Blog\Event\BlogEvent;

use Zend\EventManager\EventManager;

use Zend\EventManager\EventManagerInterface;

use Zend\EventManager\EventManagerAwareInterface;

use Blog\Entity\Post as PostEntity;

class PostService extends AbstractEntityService implements EventManagerAwareInterface
{	
	
	/**
	 * The EventManager instance 
	 * 
	 * @var EventManagerInterface
	 */
	protected $events;
	
	/**
     * Set the event manager instance used by this module manager.
     *
     * @param  EventManagerInterface $events
     * @return ModuleManager
     */
	public function setEventManager(EventManagerInterface $events)
	{
		$events->setIdentifiers(array(
            __CLASS__,
            get_class($this),
            'blog',
        ));
        $this->events = $events;
        return $this;
	}
	
	/**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
	public function getEventManager()
	{
		if (!$this->events instanceof EventManagerInterface) {
			$this->setEventManager(new EventManager());
        }
        return $this->events;
	}
	
	/**
	 * Takes a post ID and returns the database record for that post.
	 * 
	 * @param mixed $id
	 */
	public function getPost( $id, $language_code = null )
	{	
		if (empty($language_code)) {
			$languageService = $this->serviceManager->get('Blog\Service\LanguageService');
			$language_code = $languageService->getCurrent()->getId();
		} 
		
		$post = $this->repository->findOneBy(array('language' => $language_code, 'slug' => $id));
		
		// Trigger an event
		// Allows developers to modify the post object immediately after being queried and setup.
		$event = new BlogEvent();
		$event->setPost($post);
		$this->getEventManager()->trigger(BlogEvent::EVENT_THE_POST, $this, $event);
		
		$post = $event->getPost();
		
		return $post;
	}
	
	/**
	 * Gets posts records.
	 * 
	 * Options:
	 * 
	 *     posts_per_page   => 5
	 *     offset           => 0
	 *     orderby          => 'post_date'
	 *     order            => 'DESC'
	 *     post_type        => 'post'
	 *     post_status      => 'publish'
	 * 
	 * @param array $args
	 */
	public function getPosts( $args = array() )
	{	
		// Criteria...
		$criteria = array(
			'status'   => isset($args['post_status']) ? $args['post_status'] : 'publish',
			'type'     => isset($args['post_type'])   ? $args['post_type']   : 'post',
		);
		
		// Language
		if (!isset($args['language'])) {
			$languageService = $this->serviceManager->get('Blog\Service\LanguageService');
			$criteria['language'] = $languageService->getCurrent()->getId();
		}
		
		// Order By...
		$orderBy = isset($args['orderby']) ? $args['orderby'] : array('created' => 'DESC');
		if (!is_array($orderBy)) {
			$orderBy = array($orderBy => 'DESC');
		}
		
		// Limit and offset
		$limit  = isset($args['posts_per_page'])  ? $args['posts_per_page']  : 5;
		$offset = isset($args['offset']) ? $args['offset'] : 0;
		
		if ($limit < 1) $limit = null;
		if ($offset < 1) $offset = null;
		
		// Trigger an event
		// Gives developers access to the query arguments.
		$event = new BlogEvent();
		$event->setCriteria($criteria);
		$event->setOrderBy($orderBy);
		$event->setLimit($limit);
		$event->setOffset($offset);
			
		$this->getEventManager()->trigger(BlogEvent::EVENT_PRE_GET_POSTS, $this, $event);
			
		$criteria = $event->getCriteria();
		$orderBy  = $event->getOrderBy();
		$limit    = $event->getLimit();
		$offset   = $event->getOffset();
			
		if ($limit < 1) $limit = null;
		if ($offset < 1) $offset = null;
		
		// Get them!
		$posts = $this->repository->findBy($criteria, $orderBy, $limit, $offset);
		
		// TODO: Decide if we trigger an event here
		
		// Return
		return $posts;
	}
	
	/**
	 * Save a post
	 * 
	 * @param Blog\Entity\Post $post
	 */
	public function savePost(PostEntity $post )
	{
		// Modified date
		$post->modified = new DateTime(date('Y-m-d H:i:s', time()));
			
		$this->entityManager->flush($post);
	}
	
	/**
	 * Create a new post
	 * 
	 * @param Blog\Entity\Post $post
	 */
	public function createPost(PostEntity $post)
	{
		// Set the author
		// I do this first as it treats unauthorized access 
		$auth = $this->serviceManager->get('zfcuser_auth_service');
		if (!$auth->hasIdentity()) {
			throw new \Blog\Exception\UnauthorizedAccessException("You can not create new posts");
		}
		$post->author = $auth->getIdentity()->getId();
		
		// Set the language
		$language = $post->getLanguage();
		if (empty($language)) {
			$languageService = $this->serviceManager->get('Blog\Service\LanguageService');
			$language = $languageService->getDefault();
			$post->setLanguage($language);
			
		}
		
		// Set the default comment status
		if (empty($post->comment_status)) {
			$optionsService = $this->serviceManager->get('Blog\Service\OptionService');
			$default = $options->get('default_comment_status');
			if (!empty($default) && is_string($default)) {
				$post->comment_status = $default;
			} else {
				$post->comment_status = 'open';
			}
		}
		
		// Set dates
		$now = time();
		$post->created = new \DateTime(date('Y-m-d H:i:s', $now));
		$post->modified = new \DateTime(date('Y-m-d H:i:s', $now));
		
		
		$this->entityManager->persist($post);
        $this->entityManager->flush($post);
	}
}