<?php

class AdminUsersController extends BaseController
{
    public static function users()
    {
        $users = UsersRepo::getAllUsers();
        PageBuilder::build('users', ['users'=>$users]);
    }

    public static function user()
    {
        PageBuilder::build('user');
    }
}