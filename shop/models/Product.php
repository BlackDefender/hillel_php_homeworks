<?php

class Product
{
    public function getIllustrationAdmin()
    {
        return ImagesRepo::getImageUrl($this->illustration);
    }

    public function getIllustration($size = null)
    {
        $illustration = ImagesRepo::getImageUrl($this->illustration, $size);
        if(empty($illustration)){
            $illustration = ImagesRepo::getPlaceholder();
        }
        return $illustration;
    }

    public function getExcerpt($excerptLength = 100)
    {
        return substr(strip_tags($this->description), 0 , $excerptLength).'&hellip;';
    }
}