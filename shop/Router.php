<?php

class Router
{
    public function __construct($routes)
    {
        $request = explode('?', Config::getRequest())[0];
        $method = $_SERVER['REQUEST_METHOD'];

        if(explode('/', $request)[1] === 'admin'){

            PageBuilder::setMode('admin');
        }
        if (isset($routes[$method][$request])) {
            $routes[$method][$request]();
        } else {
            BaseController::setHttpStatus(404);
            PageBuilder::build('404');
        }
    }
}