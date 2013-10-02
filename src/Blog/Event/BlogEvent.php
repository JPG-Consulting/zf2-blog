<?php
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