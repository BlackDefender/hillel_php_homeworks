<?php

class AuthorController
{
    public static function posts($id)
    {
        $posts = PostsRepo::getPostsByUser($id);
        require_once 'view/main.php';
    }

    public static function comments($id){

    }
}