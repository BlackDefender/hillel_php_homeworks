<?php

class UserController extends BaseController
{
    public static function loginPage()
    {
        PageBuilder::build('login');
    }

    public static function login()
    {
        UsersRepo::login($_POST['email'], $_POST['password']);
        $user = UsersRepo::getCurrentUser();
        if ($user) {
            self::redirect('/');
        } else {
            FlashMessages::addMessage('Incorrect login', FlashMessages::MESSAGE_TYPE_ERROR);
            self::redirect('user/login');
        }
    }

    public static function logout()
    {
        UsersRepo::logout();
        self::redirect('/');
    }

    public static function registerPage()
    {
        PageBuilder::build('register');
    }

    public static function register()
    {
        if ($currentUser = UsersRepo::register($_POST['name'], $_POST['email'], $_POST['password'])) {
            $_SESSION['user'] = $currentUser;
            self::redirect('/');
        } else {
            self::redirect('user/register');
        }
    }
}