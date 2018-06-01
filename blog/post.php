<?php

require_once 'models/DB.php';
require_once 'models/Posts.php';
require_once 'models/Config.php';
require_once 'models/Comments.php';

define('SITE_URL', Config::getSiteUrl());

session_start();

if(isset($_GET['post_id'])){
    $connection = (new DB())->getConnection();

    $post = (new Posts($connection))->getPost($_GET['post_id']);
    if($post){
        $comments = (new Comments($connection))->get($post->id);
        require_once 'view/post.php';
    }else{
        header('location: '.SITE_URL);
    }
}else{
    header('location: '.SITE_URL);
}


