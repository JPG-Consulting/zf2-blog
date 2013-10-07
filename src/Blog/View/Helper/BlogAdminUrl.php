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
namespace Blog\View\Helper;

use Traversable;
use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class BlogAdminUrl extends AbstractHelper implements ServiceManagerAwareInterface
{
	/**
     * ServiceManager instance.
     *
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * RouteStackInterface instance.
     *
     * @var Zend\Mvc\Router\RouteStackInterface;
     */
    protected $router;


    public function __invoke($params = array(), $options = array())
    {	
    	if (!is_array($params)) {
            if (!$params instanceof Traversable) {
                throw new Exception\InvalidArgumentException(
                    'Params is expected to be an array or a Traversable object'
                );
            }
            $params = iterator_to_array($params);
        }
        
        $config      = $this->serviceManager->get('Blog\Config');
		$admin_route = $config->get('admin_route') . '/default';		
		$router      = $this->getRouter();
        
		// Set the name of the route
		$options['name'] = $admin_route;
		
		return $router->assemble($params, $options);
    }

    public function setServiceManager(ServiceManager $serviceManager)
    {
    	$this->serviceManager = $serviceManager;
    	return $this;
    }
    
    public function getRouter()
    {
    	if (null === $this->router) {
    		$this->router = $this->serviceManager->get('Router');
    	}
    	return $this->router;
    }

}
