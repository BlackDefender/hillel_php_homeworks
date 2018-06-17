<?php

class BlogController
{
    public static function index()
    {
        $posts = PostsRepo::getPosts();
        PageBuilder::build('main', ['posts' => $posts]);
    }
}