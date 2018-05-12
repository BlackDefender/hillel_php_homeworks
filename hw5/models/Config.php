<?php

class Config
{
    public static function getSiteUrl()
    {
        $scheme = (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) ? 'https://' : 'http://';
        $url = $_SERVER['REQUEST_URI'];
        $parts = explode('/', $url);
        $dir = $_SERVER['SERVER_NAME'];
        for ($i = 0; $i < count($parts) - 1; $i++) {
            $dir .= $parts[$i] . "/";
        }
        return $scheme.$dir;
    }
}