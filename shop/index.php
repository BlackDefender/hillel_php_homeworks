<?php

spl_autoload_register(function ($className) {
    $pathList = [
        './',
        './config/',
        './controllers/',
        './models/',
        './repos/',
        './admin/controllers/',
        './utils/',
    ];
    foreach ($pathList as $path){
        if(file_exists($path.$className.'.php')){
            require_once $path.$className.'.php';
            break;
        }
    }
});

session_start();

$acl = new ACL(Config::getRequest());
$acl->check();

require_once 'routes.php';
new Router($routes);