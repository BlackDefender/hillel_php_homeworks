<?php

class UserController
{
    public static function login($data)
    {
        if (empty($data)) {
            require_once './view/login.php';
            exit(0);
        }

        if ($currentUser = UsersRepo::check($data['email'], $data['password'])) {
            $_SESSION['user'] = $currentUser;
            header('Location: '.Config::getSiteUrl());
        } else {
            header('location: '.Config::getSiteUrl().'user/login');
        }
    }

    public static function loguot($data)
    {
        unset($_SESSION['user']);
        header('Location: '.Config::getSiteUrl());
    }

    public static function register($data)
    {
        if (empty($data)) {
            require_once './view/register.php';
            exit(0);
        }


        if ($currentUser = UsersRepo::register($data['name'], $data['email'], $data['password'])) {
            $_SESSION['user'] = $currentUser;
            header('Location: '.Config::getSiteUrl());
        } else {
            header('location: '.Config::getSiteUrl().'user/register');
        }
    }
}