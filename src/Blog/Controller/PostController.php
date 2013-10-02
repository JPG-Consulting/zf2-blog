<?php
namespace Blog\Controller;

use Zend\View\Model\ViewModel;

use Blog\Entity\Post as PostEntity;

use Zend\Mvc\Controller\AbstractActionController;

class PostController extends AbstractActionController
{

	protected $postService;
	
	protected function getPostService()
	{
		if(null === $this->postService) {
			$this->postService = $this->getServiceLocator()->get('Blog\Service\PostService');
		}
		return $this->postService;
	}
	
	public function newAction()
    {
        //if (!$this->zfcUserAuthentication()->hasIdentity()) {
        //    return $this->redirect()->toRoute('blog');
        //}
        $postEntity = new PostEntity();
        $form       = $this->getServiceLocator()->get('FormElementManager')->get('Blog\Form\CreatePost');
        $request    = $this->getRequest();
        $message    = null;

        $form->bind($postEntity);

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                //$user = $this->zfcUserAuthentication()->getIdentity();

                //$postEntity->setAuthor($user);
                $this->getPostService()->createPost($postEntity);
                //$this->flashMessenger()->setNamespace('sxblog_post')->addMessage(
                //    $this->getMessage('post_creation_success')
                //);

                //return $this->redirect()->toRoute('sx_blog/post/edit', array('slug' => $postEntity->getSlug()));
            }

            //$message = $this->getMessage('post_creation_fail');
        }

        return new ViewModel(array(
            'form'    => $form,
            //'message' => $message,
        ));

    }

}