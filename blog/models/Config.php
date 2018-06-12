<?php

class Config
{
    public static $db_host = 'localhost';
    public static $db_user = 'root';
    public static $db_password = '';
    public static $db_name = "blog";

    private static function getSubDir(){
        $scriptDir = realpath(dirname(dirname(__FILE__)));
        $serverRootDir = realpath($_SERVER['DOCUMENT_ROOT']);

        $subDir = substr($scriptDir, strlen($serverRootDir));
        $subDir = str_replace('\\', "/", $subDir);
        return trim($subDir, '/');
    }

    public static function getSiteUrl()
    {
        $subDir = self::getSubDir();
        $requestScheme = (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https' : 'http';
        $siteUrl = $requestScheme.'://'.$_SERVER['HTTP_HOST'].'/';
        if(!empty($subDir)){
            $siteUrl .= $subDir.'/';
        }
        return $siteUrl;
    }

    public static function getRequest()
    {
        $subDir = self::getSubDir();
        $request = $_SERVER['REQUEST_URI'];
        if(!empty($subDir)){
            $request = substr($request, strlen('/'.$subDir));
        }
        return $request;
    }

}