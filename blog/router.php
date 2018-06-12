<?php

class Router
{

    public static function serve()
    {
        $routeStr = Config::getRequest();
        $route = explode('/', $routeStr);
        array_shift($route);
        switch ($route[0]){
            case '':
                BlogController::index();
                break;
            case 'post':
                self::servePost(array_slice($route, 1));
                break;
            case 'user':
                self::serveUser(array_slice($route, 1));
                break;
            case 'author':
                self::serveAuthor(array_slice($route, 1));
                break;
            case 'comment':
                self::serveComment(array_slice($route, 1));
                break;
            default:
                header('location: '.Config::getSiteUrl());
                break;
        }
    }

    private static function serveComment($route){
        switch ($route[0]){
            case 'add':
                CommentController::addComment($_POST);
                break;
            case 'remove':
                CommentController::removeComment($_POST);
                break;
            default:
                header('location: '.Config::getSiteUrl());
                exit(0);
                break;
        }
    }

    private static function servePost($route)
    {
        switch ($route[0]){
            case 'add':
                PostController::addPost($_POST);
                break;
            case 'remove':
                PostController::removePost($_POST);
                break;
            default:
                $id = intval($route[0]);
                if($id !== 0){
                    PostController::showPost($id);
                }else{
                    header('location: '.Config::getSiteUrl());
                    exit(0);
                }
                break;
        }
    }

    private static function serveAuthor($route){

        $id = intval($route[0]);
        if($id !== 0){
            if(isset($route[1]) && $route[1] === 'comments'){
                AuthorController::comments($id);
            }else{
                AuthorController::posts($id);
            }
        }else{
            header('location: '.Config::getSiteUrl());
            exit(0);
        }

    }

    private static function serveUser($route){
        switch ($route[0]){
            case 'login':
                UserController::login($_POST);
                break;
            case 'logout':
                UserController::loguot($_POST);
                break;
            case 'register':
                UserController::register($_POST);
                break;
            default:
                header('location: '.Config::getSiteUrl());
                break;
        }
    }

}