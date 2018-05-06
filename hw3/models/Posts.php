<?php

class Posts
{
    private static $feeds = [
        'https://tproger.ru/feed/',
        'https://apostrophe.ua/site/allfeed',
    ];

    public static function getPosts()
    {
        $feedIndex = rand(0, count(self::$feeds)-1);
        $rss = file_get_contents(self::$feeds[$feedIndex]);
        $data = new SimpleXMLElement($rss, LIBXML_NOCDATA );
        return $data->channel->item;
    }

}