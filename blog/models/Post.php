<?php


class Post
{
    private static $excerptLength = 300;

    public function getExcerpt()
    {
        return substr(strip_tags($this->content), 0 , self::$excerptLength).'&hellip;';
    }

    public function getDate()
    {
        $format = "Y-m-d H:i:s";
        $dateobj = DateTime::createFromFormat($format, $this->pub_date);
        return $dateobj->format('d.m.Y');
    }
}