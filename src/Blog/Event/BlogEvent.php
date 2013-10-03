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
namespace Blog\Event;

use Zend\EventManager\Event;

class BlogEvent extends Event
{
	/**
     * Module events triggered by eventmanager
     */
    CONST EVENT_PRE_GET_POSTS           = 'pre_get_posts ';
    CONST EVENT_THE_POST                = 'the_post';
    
    protected $criteria;
    protected $orderBy;
    protected $limit;
    protected $offset;
    
    protected $post;
    
    public function getPost()
    {
    	return $this->post;
    }
    
    public function setPost($post)
    {
    	$this->post = $post;
    	return $this;
    }
    
    /**
     * Get SQL query criteria
     * 
     * @return array|null
     */
    public function getCriteria()
    {
    	return $this->criteria;
    }
    
    public function setCriteria($criteria)
    {
    	$this->criteria = $criteria;
    	return $this;
    }
    
	public function getOrderBy()
    {
    	return $this->orderBy;
    }
    
    public function setOrderBy($orderBy)
    {
    	$this->orderBy = $orderBy;
    	return $this;
    }
    
	public function getLimit()
    {
    	return $this->limit;
    }
    
    public function setLimit($limit)
    {
    	$this->limit = $limit;
    	return $this;
    }
    
	public function getOffset()
    {
    	return $this->post;
    }
    
    public function setOffset($offset)
    {
    	$this->offset = $offset;
    	return $this;
    }
}