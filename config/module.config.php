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
return array(
	'router' => array(
        'routes' => array(
            'blog' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/blog',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Blog\Controller',
                        'controller'    => 'Frontend',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                	'post' => array(
                		'type'    => 'Regex',
						'options' => array(
							'regex' => '/(?<slug>[a-zA-Z0-9-]+)\.html',
							'spec' => '/%slug%.html',
                			'defaults' => array(
	                        	'__NAMESPACE__' => 'Blog\Controller',
	                        	'controller'    => 'Frontend',
	                        	'action'        => 'singlePost',
	                    	),
						),
                	),
                	'admin' => array(
		            	'type'    => 'Literal',
		                'options' => array(
		                    'route'    => '/admin',
		                    'defaults' => array(
		                        '__NAMESPACE__' => 'Blog\Controller',
		                        'controller'    => 'Backend',
		                        'action'        => 'newPost',
		                    ),
		                ),
		                'may_terminate' => true,
		                'child_routes' => array(),
		            )
                ),
            ),
            
        ),
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'        => 'gettext',
                'base_dir'    => __DIR__ . '/../language',
                'pattern'     => '%s.mo',
            	'text_domain' => 'blog'
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Frontend' => 'Blog\Controller\FrontendController',
    		'Blog\Controller\Backend' => 'Blog\Controller\BackendController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine'     => array(
		'driver' => array(
            'Blog_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(
    				__DIR__ . '/../src/Blog/Entity',
    			),
            ),
            'orm_default'             => array(
                'drivers' => array(
                    'Blog\Entity' => 'Blog_driver',
                ),
            ),
        ),
    ),
);