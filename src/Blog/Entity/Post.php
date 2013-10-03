<?php
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
     * @ORM\Column(type="string", length=7)
     */
    public $language_code;
    
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
    
    public function getLanguageCode()
    {
    	return $this->language_code;
    }
    
    public function setLanguageCode( $language_code )
    {
    	$this->language_code = $language_code;
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