<?php

class BlogController
{
    public static function index()
    {
        $posts = PostsRepo::getPosts();
        require_once 'view/main.php';
    }
}