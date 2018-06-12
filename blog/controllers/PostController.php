<?php

class PostController
{
    public static function showPost($id)
    {
        if(isset($id)){
            $post = PostsRepo::getPost($id);
            if($post){
                $comments = CommentsRepo::get($post->id);
                require_once 'view/post.php';
            }else{
                header('location: '.Config::getSiteUrl());
            }
        }else{
            header('location: '.Config::getSiteUrl());
        }
    }

    public static function addPost($data)
    {
        if(empty($_SESSION['user'])){
            header('location: '.Config::getSiteUrl());
            exit(0);
        }
        if (!empty($data)) {
            PostsRepo::add($_SESSION['user']->id, $data['title'], $data['content']);
            header('location: ' . Config::getSiteUrl());
            exit(0);
        }
        require_once 'view/add-post.php';
    }

    public static function removePost($data)
    {
        if(!isset($_SESSION['user'])){
            header('location: '.Config::getSiteUrl());
            exit(0);
        }
        if(isset($data['postId'])){
            $post = PostsRepo::getPost($data['postId']);
            if($post->user_id == $_SESSION['user']->id){
                CommentsRepo::removeByPostId($post->id);
                PostsRepo::remove($post->id);
            }
        }
        header('location: '.Config::getSiteUrl());
    }
}