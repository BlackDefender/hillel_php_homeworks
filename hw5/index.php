<?php

session_start();

require_once 'models/Users.php';
require_once 'models/Config.php';

if (!isset($_SESSION['user'])) {
    require_once 'view/login.php';
    exit(0);
}

if (isset($_POST['action'])){
    switch ($_POST['action']){
        case 'add':
            $message = Users::create($_POST['name'], $_POST['email'], $_POST['password']);
            break;
        case 'edit':
            $message = Users::update($_POST['index'], $_POST['name'], $_POST['email'], $_POST['old_password'], $_POST['new_password']);
            break;
        case 'remove':
            Users::remove($_POST['index']);
            break;
    }
}


$usersList = Users::get();

require_once 'view/main.php';
