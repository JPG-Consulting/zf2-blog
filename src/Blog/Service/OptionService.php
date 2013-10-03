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

use Blog\Entity\Option;

class OptionService extends AbstractEntityService
{
	
	/**
	 * Get an option from the database configuration
	 * 
	 * @param string $option The option name
	 * @return mixed
	 */
	public function get($option)
	{
		$option = $this->getRepository()->find($option);
		if (empty($option)) return null;
		return $option->getValue();
	}
	
	/**
	 * Set an option in the database configurtion.
	 * 
	 * @param string $option The option name
	 * @param mixed $value The option value
	 */
	public function set($option, $value)
	{
		$the_option = $this->getRepository()->find($option);
		if (!empty($the_option)) {
			$the_option->setValue($value);
		} else {
			$the_option = new Option();
			$the_option->setKey($option);
			$the_option->setValue($value);
			$this->getEntityManager()->persist($the_option);
		}
		
		$this->getEntityManager()->flush($the_option);
	}
	
	/**
	 * Magic for implicit getters and setters.
	 * 
	 * @param string $name
	 * @param mixed $arguments
	 */
	public function __call($name, $arguments)
	{
		if (preg_match('~^(set|get)([A-Z])(.*)$~', $name, $matches)) {
			$option = strtolower($matches[2]) . $matches[3];
			// CameCase to underscore
			$option = preg_replace('/(?!^)[[:upper:]][[:lower:]]/', '$0', preg_replace('/(?!^)[[:upper:]]+/', '_$0', $option));
			
			switch($matches[1]) {
				case 'get':
					return $this->get($option);
					break;
				case 'set':
					$this->set($option, $arguments);
					break;
				default:
					// TODO: Throw exception
			}	
		}
	}
}