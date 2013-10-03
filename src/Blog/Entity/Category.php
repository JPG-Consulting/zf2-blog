<?php
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Blog\Repository\Post")
 * @ORM\Table(name="categories")
 */
class Category
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
    protected $name;
    
    
}