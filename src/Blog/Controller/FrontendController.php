<?php
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
    	
		return new ViewModel(array(
			'post' => $post
		));
	}
}