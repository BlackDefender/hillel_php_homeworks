<?php

require_once 'models/ToDoList.php';

$toDoList = new ToDoList();

if(isset($_POST['action'])){
    switch ($_POST['action']){
        case 'add':
            $toDoList->add($_POST['text']);
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

$todos = $toDoList->get();

require_once 'view/main.php';