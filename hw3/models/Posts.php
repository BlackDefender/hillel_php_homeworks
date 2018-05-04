<?php

class Posts
{
    private $feeds = [
        'https://tproger.ru/feed/',
        'https://apostrophe.ua/site/allfeed',
    ];

    public function getPosts()
    {
        $feedIndex = rand(0, count($this->feeds)-1);
        $rss = file_get_contents($this->feeds[$feedIndex]);
        $data = new SimpleXMLElement($rss, LIBXML_NOCDATA );
        return $data->channel->item;
    }

}