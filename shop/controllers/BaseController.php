<?php

class BaseController
{
    public static function setHttpStatus($statusId = 200)
    {
        switch ($statusId){
            case 401:
                $statusText = '401 Unauthorized';
                break;
            case 404:
                $statusText = '404 not found';
                break;
            default:
                $statusText = '200 OK';
                break;
        }
        header($_SERVER['SERVER_PROTOCOL'].' '.$statusText);
    }

    public static function redirect($url)
    {
        $url = trim($url, '/');
        $url .= '/';
        if($url === '/') $url = '';
        header('Location: '.Config::getSiteUrl().$url);
        exit(0);
    }
}