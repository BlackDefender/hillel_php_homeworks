<?php

class AdminUsersController extends BaseController
{
    public static function users()
    {
        PageBuilder::build('users');
    }
    public static function user()
    {
        PageBuilder::build('user');
    }
}