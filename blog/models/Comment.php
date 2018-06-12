<?php

class Comment
{
    public function getDate($format = 'd.m.Y H:i')
    {
        $dbFormat = "Y-m-d H:i:s";
        $dateObj = DateTime::createFromFormat($dbFormat, $this->pub_date);
        return $dateObj->format($format);
    }
}