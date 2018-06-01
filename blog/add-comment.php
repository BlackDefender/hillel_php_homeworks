<?php

require_once 'models/Config.php';
require_once 'models/DB.php';
require_once 'models/Comments.php';

define('SITE_URL', Config::getSiteUrl());

session_start();

if(!empty($_POST)){
    $commentsModel = new Comments((new DB())->getConnection());
    $commentsModel->add($_POST['post_id'], $_POST['user_id'], $_POST['comment']);
    header('location: '.SITE_URL.'post.php?post_id='.intval($_POST['post_id']));
}else{
    header('location: '.SITE_URL);
}