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
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity(repositoryClass="Blog\Repository\Post")
 * @ORM\Table(name="posts")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Blog\Entity\Language")
     * @ORM\JoinColumn(name="language", referencedColumnName="iso")
     */
    public $language;
    
    /**
     * @var string
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=7)
     */
    public $slug;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=255)
     */
    public $title;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="text")
     */
    public $content;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    public $excerpt;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=20)
     */
    public $type = 'post';
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=20)
     */
    public $status = 'draft';
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=20)
     */
    public $comment_status = 'open';
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    public $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    public $modified;
    
    /**
     * @ORM\Column(type="integer")
     */ 
    public $author;
    
    
    /**************************************
     *  G E T T E R S   &   S E T T E R S *
     **************************************/
    
    //public function getLanguageIso()
    //{
    //	return $this->language->getId();
    //}
    
    public function getLanguage()
    {
    	return $this->language;
    }
    
    public function setLanguage( $language )
    {
    	$this->language = $language;
    	return $this;
    }
    
    public function getSlug()
    {
    	return $this->slug;
    }
    
    public function setSlug( $slug )
    {
    	$this->slug = $slug;
    	return $this;
    }
    
    public function getTitle()
    {
    	return $this->title;
    }
    
    public function setTitle( $title )
    {
    	$this->title = $title;
    	return $this;
    }
    
    public function getContent()
    {
    	return $this->content;
    }
    
	public function setContent( $content )
    {
    	$this->content = $content;
    	return $this;
    }
    
	public function getExcerpt()
    {
    	return $this->excerpt;
    }
    
    public function setExcerpt( $excerpt )
    {
    	$this->excerpt = $excerpt;
    }
    
    public function getType()
    {
    	return $this->type;
    }
    
    public function setType( $type )
    {
    	$this->type = $type;
    	return $this;
    }
    
    public function getStatus()
    {
    	return $this->status;
    }
    
    public function setStatus( $status )
    {
    	$this->status = $status;
    	return $this;
    }
    
    public function getCommentStatus()
    {
    	return $this->comment_status;
    }
    
    public function setCommentStatus( $status )
    {
    	$this->comment_status = $status;
    	return $this;
    }
    
    public function getCreated()
    {
    	return $this->created;
    }
    
    public function getModified()
    {
    	return $this->modified;
    }
    
}