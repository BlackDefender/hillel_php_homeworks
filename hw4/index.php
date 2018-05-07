<?php

require_once 'models/User.php';
require_once 'models/Users.php';
require_once 'models/Config.php';


if(isset($_GET['remove_index'])){
    Users::remove($_GET['remove_index']);
    header('Location: '.Config::getSiteUrl());
}

if (isset($_POST['action'])){
    switch ($_POST['action']){
        case 'add':
            Users::add(new User($_POST['name'], $_POST['email']));
            break;
        case 'edit':
            Users::update($_POST['index'], new User($_POST['name'], $_POST['email']));
            break;
    }
}


$usersList = Users::get();

require_once 'view/main.php';
