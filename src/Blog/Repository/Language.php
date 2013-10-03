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

namespace Blog\Repository;

use Doctrine\ORM\EntityRepository;

class Language extends EntityRepository
{

	/**
	 * Finds a language by its ISO-639-1 2-letter code
	 *
	 * @param string $iso The iso code for the language
	 * @return Blog\Entity\Language The language object
	 */
	public function find( $iso )
	{
		return $this->findOneBy(array('iso' => $iso));
	}
	
	/**
	 * Find all active repositories
	 * 
	 * @return array The entities
	 */
	public function findAllActive()
	{
		return $this->findBy(array('active' => 1));	
	}
	
}
