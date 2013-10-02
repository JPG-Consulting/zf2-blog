<?php
namespace Blog\Controller;


use Zend\View\Model\ViewModel;

use Zend\Mvc\Controller\AbstractActionController;

class IndexController extends AbstractActionController
{

	public function IndexAction()
	{
		$postService = $this->serviceLocator->get('Blog\Service\PostService');
		$posts = $postService->getPosts();
		return new ViewModel(array(
			'Posts' => $posts
		));	
	}
}