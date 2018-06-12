<?php

class CommentController
{
    public static function addComment($data)
    {
        if(!empty($data)){
            CommentsRepo::add($data['postId'], $data['userId'], $data['comment']);
            header('location: '.SITE_URL.'post/'.intval($data['postId']));
        }else{
            header('location: '.SITE_URL);
        }
    }

    public static function removeComment($data)
    {

    }
}