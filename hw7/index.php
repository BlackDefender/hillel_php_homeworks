<?php
require_once 'models/DB.php';
require_once 'models/ToDoList.php';
require_once 'models/Users.php';
require_once 'models/Config.php';
session_start();

if(!isset($_SESSION['user'])){
    header('location: '.Config::getSiteUrl().'login.php');
    exit(0);
}

$toDoList = new ToDoList((new DB())->getConnection());

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
}

$todos = $toDoList->get($_SESSION['user']->id);

require_once 'view/main.php';