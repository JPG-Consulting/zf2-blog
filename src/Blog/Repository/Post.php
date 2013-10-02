<?php
/**
 * Ideas from: https://github.com/SpoonX/SxBlog/blob/master/src/SxBlog/Repository/PostRepository.php
 */
namespace Blog\Repository;

use Doctrine\ORM\EntityRepository;

class Post extends EntityRepository
{

	/**
	 * Find a post by slug.
	 * 
	 * @param string $slug
	 * @return \Blog\Entity\Post 
	 */
	public function findBySlug( $slug )
	{
		return $this->findBy(array('name' => $slug));
	}
}