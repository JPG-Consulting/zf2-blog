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
namespace Blog;

use Zend\ModuleManager\Feature\RouteProviderInterface;

use Blog\View\Helper\GetPostAuthor;

use Blog\View\Helper\BlogAdminUrl;

use Zend\ModuleManager\ModuleManagerInterface;

use Zend\ModuleManager\Feature\InitProviderInterface;

use Blog\View\Helper\GetPostUrl;

use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

use Zend\ModuleManager\Feature\FormElementProviderInterface;

use Blog\Service\PostService;

use Zend\ModuleManager\Feature\ServiceProviderInterface;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;

class Module implements 
	AutoloaderProviderInterface, 
	ConfigProviderInterface, 
	FormElementProviderInterface, 
	InitProviderInterface,
	ServiceProviderInterface, 
	ViewHelperProviderInterface
{

	/**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
	public function getAutoloaderConfig()
	{
		return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
	}
	
	/**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getFormElementConfig()
	{
		return array(
		    'factories' => array(
		        'Blog\Form\CreatePost' => function ($sm) {
					$entityManager = $sm->getServiceLocator()->get('Doctrine\ORM\EntityManager');
					// Post fieldset
					$postFieldset = new Form\Fieldset\Post($entityManager);
					$postFieldset->setUseAsBaseFieldset(true);
					
					// Form
		            $createPostForm = new Form\CreatePost();
		            $createPostForm->add($postFieldset);
		
		            return $createPostForm;
		        },
		    ),
		);
	}
	/**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Blog\Service\PostService'     => 'Blog\Service\Factory\PostServiceFactory',
				'Blog\Service\OptionService'   => 'Blog\Service\Factory\OptionServiceFactory',
				'Blog\Service\LanguageService' => 'Blog\Service\Factory\LanguageServiceFactory',
				'Blog\Config'                  => 'Blog\Service\Factory\ConfigFactory',
			),
		);
	}
	
	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'getPostAuthor' => function($helperPluginManager) {
					$serviceLocator = $helperPluginManager->getServiceLocator();
					$viewHelper = new GetPostAuthor();
					$viewHelper->setServiceManager($serviceLocator);
					return $viewHelper;
				},
				'getPostUrl' => function($helperPluginManager) {
					$serviceLocator = $helperPluginManager->getServiceLocator();
					$router = $serviceLocator->get('Router');
					$viewHelper = new GetPostUrl();
					$viewHelper->setRouter($router);
					return $viewHelper;
				},
				'blogAdminUrl' => function($helperPluginManager) {
					$serviceLocator = $helperPluginManager->getServiceLocator();
					$viewHelper = new BlogAdminUrl();
					$viewHelper->setServiceManager( $serviceLocator );
					return $viewHelper;
				}
			)
		);
	}
	
	public function init(ModuleManagerInterface $manager)
	{
		$sharedEventManager  = $manager->getEventManager()->getSharedManager();
		
		// Load the backend template if we are using the backend
		// A bit redundant... but it's late at night...
		$sharedEventManager->attach(__NAMESPACE__, \Zend\Mvc\MvcEvent::EVENT_DISPATCH, function($e) {
			$controller = $e->getTarget();
			$reflection =  new \ReflectionClass( get_class($controller) );
			$controller_namespace  = $reflection->getNamespaceName();
			
			if (strcasecmp($controller_namespace, 'Blog\Controller\Backend') === 0) {
				// Check if user is logged in
				$sm = $e->getApplication()->getServiceManager();
				$auth = $sm->get('zfcuser_auth_service');
				if ($auth->hasIdentity()) {
					$controller->layout('blog/backend/layout');
				} else {
					$controller->plugin('redirect')->toRoute('zfcuser/authenticate');
					$e->stopPropagation();
        			return false;
				}
			}
            
		}, 10000);
		
	}
	
}