<?php

$routes = [
    'GET' => [
        '/' => 'PagesController::index',
        '/cart/' => 'CartController::index',
        //'/product/' => '',
        '/admin/' => 'AdminMainController::index',
        '/admin/product/' => 'AdminProductsController::product',
        '/admin/products/' => 'AdminProductsController::products',
        '/admin/user/' => 'AdminUsersController::user',
        '/admin/users/' => 'AdminUsersController::users',
    ],
    'POST' => [
        '/admin/product/' => 'AdminProductsController::product',
        '/admin/product/remove/' => 'AdminProductsController::removeProduct',
        '/cart/add/' => 'CartController::add',
        '/cart/clear/' => 'CartController::clear',
    ],
];