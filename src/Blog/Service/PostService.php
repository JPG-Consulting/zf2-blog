<?php
namespace Blog\Service;

use Blog\Event\BlogEvent;

use Zend\EventManager\EventManager;

use Zend\EventManager\EventManagerInterface;

use Zend\EventManager\EventManagerAwareInterface;

use Doctrine\Common\Persistence\ObjectManager;

use Blog\Entity\Post as PostEntity;

class PostService implements EventManagerAwareInterface
{
	/**
	 * The entity manager
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $entityManager;
	
	protected $repository;
	
	/**
	 * EventManager instance
	 * 
     * @var EventManagerInterface
     */
	protected $events;
	
	public function __construct(ObjectManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}
	
	/**
	 * Get the Doctrine repository for posts.
	 * 
	 * @return \Blog\Repository\Post 
	 */
	public function getRepository()
	{
		if (null === $this->repository) {
			$this->repository = $this->entityManager->getRepository('Blog\Entity\Post');
		}
		return $this->repository;
	}
	
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
	public function getPost( $id )
	{
		$post = $this->getRepository()->find($id);
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
			'status' => isset($args['post_status']) ? $args['post_status'] : 'publish',
			'type'   => isset($args['post_type'])   ? $args['post_type']   : 'post',
		);
		
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
		$posts = $this->getRepository()->findBy($criteria, $orderBy, $limit, $offset);
		
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
		// Get the setup options
		$options = $this->entityManager->getRepository('Blog\Entity\Option');
		
		// Set the language code
		if (empty($post->language_code)) {
			$default = $options->find('default_language_code');
			if (!empty($default)) {
				$post->language_code = $default->getValue();
			} else {
				$default = \Locale::getDefault();
				$post->language_code = \Locale::getPrimaryLanguage($default);
			}		
		}
		
		// Set the default comment status
		if (empty($post->comment_status)) {
			$default = $options->find('default_comment_status');
			if (!empty($default) && is_string($default)) {
				$post->comment_status = $default;
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