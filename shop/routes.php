<?php

$routes = [
    'GET' => [
        '/' => 'PagesController::index',

        '/user/login/' => 'UserController::loginPage',
        '/user/register/' => 'UserController::registerPage',

        '/cart/' => 'CartController::index',

        '/order/' => 'OrderController::index',

        //'/product/' => '',

        '/admin/' => 'AdminMainController::index',
        '/admin/product/' => 'AdminProductsController::product',
        '/admin/products/' => 'AdminProductsController::products',
        '/admin/user/' => 'AdminUsersController::user',
        '/admin/users/' => 'AdminUsersController::users',
    ],
    'POST' => [
        '/user/login/' => 'UserController::login',
        '/user/register/' => 'UserController::register',
        '/user/logout/' => 'UserController::logout',

        '/cart/add/' => 'CartController::add',
        '/cart/subtract/' => 'CartController::subtract',
        '/cart/clear/' => 'CartController::clear',
        '/cart/submit/' => 'CartController::submit',
        '/cart/remove/' => 'CartController::remove',

        '/admin/product/' => 'AdminProductsController::product',
        '/admin/product/remove/' => 'AdminProductsController::removeProduct',
        '/admin/cache/clear/' => 'AdminMainController::clearImagesCache',
    ],
];