<?php

class Config
{
    public static $db_host = 'localhost';
    public static $db_user = 'root';
    public static $db_password = '';
    public static $db_name = "shop";

    public static $imagesUploadDir = 'uploads/images/';

    private static $siteUrl = null;
    private static $siteDir = null;
    private static $subDir = null;

    private static function getSubDir(){
        if(!self::$subDir){
            $scriptDir = realpath(dirname(dirname(__FILE__)));
            $serverRootDir = realpath($_SERVER['DOCUMENT_ROOT']);
            $subDir = substr($scriptDir, strlen($serverRootDir));
            $subDir = str_replace('\\', "/", $subDir);
            self::$subDir = trim($subDir, '/');
        }
        return self::$subDir;
    }

    public static function getSiteDir()
    {
        if(!self::$siteDir){
            self::$siteDir = realpath(dirname(dirname(__FILE__))).'/';
        }
        return self::$siteDir;
    }

    public static function getSiteUrl()
    {
        if(!self::$siteUrl){
            $subDir = self::getSubDir();
            $requestScheme = (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 'https' : 'http';
            $siteUrl = $requestScheme.'://'.$_SERVER['HTTP_HOST'].'/';
            if(!empty($subDir)){
                $siteUrl .= $subDir.'/';
            }
            self::$siteUrl = $siteUrl;
        }
        return self::$siteUrl;
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