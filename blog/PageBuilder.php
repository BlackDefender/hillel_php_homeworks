<?php

class PageBuilder
{
    public static function build($page, $arguments = [])
    {
        if(isset($page) && file_exists('view/pages/'.$page.'.php')){
            extract($arguments);
            define('PAGE', $page);
            define('SITE_URL', Config::getSiteUrl());
            require_once 'view/parts/header.php';
            require_once 'view/pages/'.$page.'.php';
        }else{
            define('PAGE', '404');
            require_once 'view/parts/header.php';
            require_once 'view/pages/404.php';
        }

        require_once 'view/parts/footer.php';
    }
}