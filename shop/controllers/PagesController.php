<?php

class PagesController extends BaseController
{
    public static function index()
    {
        $products = ProductsRepo::getProducts();
        PageBuilder::build('main', ['products' => $products]);
    }
}