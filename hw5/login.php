<?php

session_start();

require_once 'models/Users.php';
require_once 'models/Config.php';


if (empty($_POST)) {
    require_once './view/login.php';
    exit(0);
}

if ($currentUser = Users::check($_POST['email'], $_POST['password'])) {
    $_SESSION['user'] = $currentUser;
    header('Location: '.Config::getSiteUrl());
} else {
    header('location: '.Config::getSiteUrl().'login.php');
}