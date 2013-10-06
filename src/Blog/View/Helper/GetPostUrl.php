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

use Zend\View\Helper\AbstractHelper;

class GetPostUrl extends AbstractHelper
{
	/**
     * RouteStackInterface instance.
     *
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * Generates an url given the name of a route.
     *
     * @see    Zend\Mvc\Router\RouteInterface::assemble()
     * @param  string               $name               Name of the route
     * @param  array                $params             Parameters for the link
     * @param  array|Traversable    $options            Options for the route
     * @param  bool                 $reuseMatchedParams Whether to reuse matched parameters
     * @return string Url                         For the link href attribute
     * @throws Exception\RuntimeException         If no RouteStackInterface was provided
     * @throws Exception\RuntimeException         If no RouteMatch was provided
     * @throws Exception\RuntimeException         If RouteMatch didn't contain a matched route name
     * @throws Exception\InvalidArgumentException If the params object was not an array or \Traversable object
     */
    public function __invoke($slug)
    {
        if (null === $this->router) {
            throw new Exception\RuntimeException('No RouteStackInterface instance provided');
        }

        if (empty($slug) || !is_string($slug)) {
            throw new Exception\InvalidArgumentException('Slug is expected to be a string');
        }

        return $this->router->assemble(array('slug' => $slug), array('name' => 'blog/post'));
        
    }

    /**
     * Set the router to use for assembling.
     *
     * @param RouteStackInterface $router
     * @return Url
     */
    public function setRouter( $router)
    {
        $this->router = $router;
        return $this;
    }

}