<?php

class AdminMainController extends BaseController
{
    public static function index()
    {
        $productsCount = ProductsRepo::getProductsCount();
        PageBuilder::build('main', ['productsCount' => $productsCount]);
    }
}