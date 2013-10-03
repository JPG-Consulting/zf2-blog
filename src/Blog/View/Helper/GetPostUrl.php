<?php

namespace Blog\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetPostUrl extends AbstractHelper
{
	/**
     * RouteStackInterface instance.
     *
     * @var RouteStackInterface
     */
    protected $router;

    /**
     * Generates an url given the name of a route.
     *
     * @see    Zend\Mvc\Router\RouteInterface::assemble()
     * @param  string               $name               Name of the route
     * @param  array                $params             Parameters for the link
     * @param  array|Traversable    $options            Options for the route
     * @param  bool                 $reuseMatchedParams Whether to reuse matched parameters
     * @return string Url                         For the link href attribute
     * @throws Exception\RuntimeException         If no RouteStackInterface was provided
     * @throws Exception\RuntimeException         If no RouteMatch was provided
     * @throws Exception\RuntimeException         If RouteMatch didn't contain a matched route name
     * @throws Exception\InvalidArgumentException If the params object was not an array or \Traversable object
     */
    public function __invoke($slug)
    {
    	//return "moneo";
    	
        if (null === $this->router) {
            throw new Exception\RuntimeException('No RouteStackInterface instance provided');
        }

        if (empty($slug) || !is_string($slug)) {
            throw new Exception\InvalidArgumentException('Slug is expected to be a string');
        }

        return $this->router->assemble(array('slug' => $slug), array('name' => 'blog/post'));
        
    }

    /**
     * Set the router to use for assembling.
     *
     * @param RouteStackInterface $router
     * @return Url
     */
    public function setRouter( $router)
    {
        $this->router = $router;
        return $this;
    }

}