<?php
require_once 'models/DB.php';
require_once 'models/Posts.php';
require_once 'models/Users.php';
require_once 'models/Config.php';

define('SITE_URL', Config::getSiteUrl());

session_start();


$postsModel = new Posts((new DB())->getConnection());


/*
if(isset($_POST['action'])){
    switch ($_POST['action']){
        case 'add':
            $toDoList->add($_SESSION['user']->id, $_POST['text']);
            break;
        case 'setAsDone':
            $toDoList->changeState($_POST['id'], 1);
            break;
        case 'setAsNew':
            $toDoList->changeState($_POST['id'], 0);
            break;
        case 'remove':
            $toDoList->remove($_POST['id']);
            break;
    }
}*/

if(isset($_GET['user_id'])){
    $posts = $postsModel->getPostsByUser($_GET['user_id']);
}else{
    $posts = $postsModel->getPosts();
}


require_once 'view/main.php';