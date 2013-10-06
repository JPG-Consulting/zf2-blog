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
     * @var string
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=2)
     */
	public $lang;
    
    /**
     * @var string
     * 
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
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
    public $date_created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    public $date_modified;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $date_published;
    
    /**
     * @ORM\Column(type="integer")
     */ 
    public $author;
    
    
    /**************************************
     *  G E T T E R S   &   S E T T E R S *
     **************************************/
    
    
    public function getLanguage()
    {
    	return $this->lang;
    }
    
    public function setLanguage( $language )
    {
    	$this->lang = $language;
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
    
    public function getDateCreated()
    {
    	return $this->date_created;
    }
    
    public function getDateModified()
    {
    	return $this->date_modified;
    }
    
	public function getDatePublished()
    {
    	return $this->date_published;
    }
    
    public function getAuthor()
    {
    	return $this->author;
    }
}