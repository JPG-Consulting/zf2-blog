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

                // Route to the post
                return $this->redirect()->toRoute('blog/post', array('slug' => $postEntity->getSlug()));
            }

            //$message = $this->getMessage('post_creation_fail');
        }

        return new ViewModel(array(
            'form'    => $form,
            //'message' => $message,
        ));

    }

}