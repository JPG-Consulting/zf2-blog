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
namespace Blog\Service;

use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractEntityService
{
	
	/**
	 * 
	 * Enter description here ...
	 * @var Zend\ServiceManager\ServiceManager
	 */
	protected $serviceManager;
	
	/**
	 * The entity manager
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $entityManager;

	/**
	 * The repository
	 * @return Doctrine\Orm\EntityRepository
	 */
	protected $repository;
	
	
	public function __construct(ServiceLocatorInterface $serviceManager, $repository)
	{
		// Service manager
		$this->serviceManager = $serviceManager;
		// Now for the repository
		$this->entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
		$this->repository = $this->entityManager->getRepository($repository);
	}
	
	
	
}