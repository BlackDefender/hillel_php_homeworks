<?php

class PageBuilder
{
    private static $mode = 'catalog';

    private static $templatesPath = [
        'catalog' => 'templates',
        'admin' => 'admin/templates',
    ];

    public static function build($page, $arguments = [])
    {
        if(self::$mode == 'catalog'){
            $cart = CartRepo::getCart();
        }
        if(isset($page) && file_exists(self::$templatesPath[self::$mode].'/pages/'.$page.'.php')){
            extract($arguments);
            define('PAGE', $page);
            define('SITE_URL', Config::getSiteUrl());
            require_once self::$templatesPath[self::$mode].'/parts/header.php';
            require_once self::$templatesPath[self::$mode].'/pages/'.$page.'.php';
        }else{
            define('PAGE', '404');
            require_once self::$templatesPath[self::$mode].'/parts/header.php';
            require_once self::$templatesPath[self::$mode].'/pages/404.php';
        }

        require_once self::$templatesPath[self::$mode].'/parts/footer.php';
    }

    public static function setMode($mode)
    {
        self::$mode = $mode;
    }
}