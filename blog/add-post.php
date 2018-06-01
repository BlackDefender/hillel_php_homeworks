<?php

require_once 'models/DB.php';
require_once 'models/Posts.php';
require_once 'models/Users.php';
require_once 'models/Config.php';

define('SITE_URL', Config::getSiteUrl());

session_start();


if(empty($_SESSION['user'])){
    header('location: '.SITE_URL);
    exit(0);
}

if(!empty($_POST)){

    $postsModel = new Posts((new DB())->getConnection());
    $postsModel->add($_SESSION['user']->id, $_POST['title'], $_POST['content']);
    header('location: '.SITE_URL);
    exit(0);
}

require_once 'view/add-post.php';
