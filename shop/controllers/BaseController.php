<?php

class BaseController
{
    protected static function redirect($url)
    {
        header('location: '.Config::getSiteUrl().$url);
        exit(0);
    }
}