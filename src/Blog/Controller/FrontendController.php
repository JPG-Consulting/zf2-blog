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
namespace Blog\Controller;


use Zend\View\Model\ViewModel;

use Zend\Mvc\Controller\AbstractActionController;

class FrontendController extends AbstractActionController
{

	public function IndexAction()
	{
		$postService = $this->serviceLocator->get('Blog\Service\PostService');
		$posts = $postService->getPosts();
		return new ViewModel(array(
			'Posts' => $posts
		));	
	}
	
	public function singlePostAction()
	{
		$slug = $this->params()->fromRoute('slug');
		
		$postService = $this->serviceLocator->get('Blog\Service\PostService');
		$post = $postService->getPost( $slug );
		
		if (empty($post)) {
    		// Post does not exist so return 404
    		$this->getResponse()->setStatusCode(404);
			return;
    	}
    	
    	// TODO: Author or admin can see the post
    	if (strcasecmp($post->getStatus(), 'publish') !== 0) {
    		// Not published so return 404
    		$this->getResponse()->setStatusCode(404);
			return;
    	}
    	
    	// Get the author data
    	
    	
    	// Set the title to the post title
    	$renderer = $this->getServiceLocator()->get('Zend\View\Renderer\PhpRenderer');
    	$renderer->headTitle($post->getTitle());
    	
    	// TODO: meta-description
    	
    	
		return new ViewModel(array(
			'post' => $post
		));
	}
	
	public function categoryAction()
	{
		return new ViewModel();
	}
}