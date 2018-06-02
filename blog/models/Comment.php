<?php

class Comment
{
    public function getDate()
    {
        $format = "Y-m-d H:i:s";
        $dateobj = DateTime::createFromFormat($format, $this->pub_date);
        return $dateobj->format('d.m.Y H:i');
    }
}