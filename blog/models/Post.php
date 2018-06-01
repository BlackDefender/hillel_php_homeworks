<?php


class Post
{
    private static $excerptLength = 300;

    public function getExcerpt(){
        return substr(strip_tags($this->content), 0 , self::$excerptLength).'&hellip;';
    }
}