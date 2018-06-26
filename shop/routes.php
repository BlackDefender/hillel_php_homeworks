<?php

$routes = [
    'GET' => [
        '/' => function(){PagesController::index();},
        '/cart/' => function(){CartController::index();},
        //'/product/' => function(){},
        '/admin/' => function (){AdminMainController::index();},
        '/admin/product/' => function (){AdminProductsController::product();},
        '/admin/products/' => function (){AdminProductsController::products();},
        '/admin/user/' => function (){AdminUsersController::user();},
        '/admin/users/' => function (){AdminUsersController::users();},
    ],
    'POST' => [
        '/admin/product/' => function (){AdminProductsController::product();},
        '/admin/product/remove/' => function (){AdminProductsController::removeProduct();},
        '/cart/add/' => function(){CartController::add();},
    ],
];