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

class Post extends EntityRepository
{

	public function findNextSlugId($language, $slug )
	{
		$post = $this->findOneBy(array('lang' => $language, 'slug' => $slug));
		if (empty($post)) return 0;
		
		
		// A post already exists with this slug for this language
		// How many more are there?
		$query = $this->_em->createQuery('SELECT p.slug FROM Blog\Entity\Post p WHERE p.lang = :lang AND p.slug LIKE :slug');
		$query->setParameters(array('lang' => $language, 'slug' => $slug . '-%'));
		$results = $query->execute();

		if(empty($results)) return 1;

		$ids = array();
		$pattern = '/^' . preg_replace('/\-/', '\-', $slug) . '-([0-9]+)$/';
		foreach($results as $result) {
			if (preg_match($pattern, $result['slug'], $m)) 
				$ids[] = (int) $m[1];
		}
		
		$id = max($ids) + 1;
		return $id;
	}

}