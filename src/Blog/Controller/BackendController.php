<?php
namespace Blog\Controller;

use Zend\View\Model\ViewModel;

use Blog\Entity\Post as PostEntity;

use Zend\Mvc\Controller\AbstractActionController;

class BackendController extends AbstractActionController
{

	protected $postService;
	
	protected function getPostService()
	{
		if(null === $this->postService) {
			$this->postService = $this->getServiceLocator()->get('Blog\Service\PostService');
		}
		return $this->postService;
	}
	
	public function newPostAction()
    {
        $postEntity = new PostEntity();
        $form       = $this->getServiceLocator()->get('FormElementManager')->get('Blog\Form\CreatePost');
        $request    = $this->getRequest();
        $message    = null;

        $form->bind($postEntity);

        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {

                $this->getPostService()->createPost($postEntity);

                //return $this->redirect()->toRoute('blog/admin/post/edit', array('slug' => $postEntity->getSlug()));
            }

            //$message = $this->getMessage('post_creation_fail');
        }

        return new ViewModel(array(
            'form'    => $form,
            //'message' => $message,
        ));

    }

}