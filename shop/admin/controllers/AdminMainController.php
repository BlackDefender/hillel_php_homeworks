<?php

class AdminMainController extends BaseController
{
    public static function index()
    {
        PageBuilder::build('main');
    }
}