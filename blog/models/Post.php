<?php

class Post
{
    public function getExcerpt($excerptLength = 300)
    {
        return substr(strip_tags($this->content), 0 , $excerptLength).'&hellip;';
    }

    public function getDate()
    {
        $format = "Y-m-d H:i:s";
        $dateobj = DateTime::createFromFormat($format, $this->pub_date);
        return $dateobj->format('d.m.Y');
    }
}