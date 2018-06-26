<?php

class Router
{
    private $r;
    private $method;
    private $routes;
    public function __construct($routes)
    {
        $this->r = explode('?', Config::getRequest())[0];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->routes = $routes;
    }

    public function serve()
    {
        if(explode('/', $this->r)[1] === 'admin'){
            PageBuilder::setMode('admin');
        }
        if (isset($this->routes[$this->method][$this->r])) {
            $this->routes[$this->method][$this->r]();
        } else {
            PageBuilder::build('404');
        }
    }
}