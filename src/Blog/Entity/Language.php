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
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Blog\Repository\Language")
 * @ORM\Table(name="Languages")
 */
class Language
{
	/**
	 * @var string
	 * 
     * @ORM\Id
     * @ORM\Column(type="string", length=2)
     */
	public $iso;
	
	/**
	 * @var string
	 * 
     * @ORM\Column(type="string", length=64)
     */
	public $english_name;
	
	/**
	 * @var string
	 * 
     * @ORM\Column(type="string", length=64)
     */
	public $native_name;
	
	/**
	 * @var bool
	 * 
     * @ORM\Column(type="boolean")
     */
	public $active;
	
	public function getId()
	{
		return $this->iso;
	}
	
	public function setId( $iso )
	{
		$this->iso = $iso;
		return $this;
	}
	
	public function getEnglishName()
	{
		return $this->english_name;
	}
	
	public function setEnglishName( $name )
	{
		$this->english_name = $name;
		return $this;
	}
	
	public function getNativeName()
	{
		return $this->native_name;
	}
	
	public function setNativeName( $name )
	{
		$this->native_name = $name;
		return $this;
	}
	
	public function getState()
	{
		return $this->active;
	}
	
	public function setState( $state )
	{
		$this->active = $state;
		return $this;
	}
	
	public function activate()
	{
		$this->active = true;
		return $this;
	}
	
	public function deactivate()
	{
		$this->active = false;
		return $this;
	}
	
	public function isActive()
	{
		return $this->active;
	}
	
	
	public function getEnglish_name()
	{
		return $this->english_name;
	}
}