<?php

spl_autoload_register(function ($className) {
    $pathList = [
        './',
        './config/',
        './controllers/',
        './models/',
        './repos/',
        './admin/controllers/',

    ];
    foreach ($pathList as $path){
        if(file_exists($path.$className.'.php')){
            require_once $path.$className.'.php';
            break;
        }
    }
});

session_start();

require_once 'routes.php';
$router = new Router($routes);
$router->serve();