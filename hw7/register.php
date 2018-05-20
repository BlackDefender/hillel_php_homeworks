<?php
require_once 'models/Config.php';
require_once 'models/DB.php';
require_once 'models/Users.php';
session_start();

if (empty($_POST)) {
    require_once './view/register.php';
    exit(0);
}

$users = new Users((new DB())->getConnection());

if ($currentUser = $users->register($_POST['name'], $_POST['email'], $_POST['password'])) {
    $_SESSION['user'] = $currentUser;
    header('Location: '.Config::getSiteUrl());
} else {
    header('location: '.Config::getSiteUrl().'register.php');
}