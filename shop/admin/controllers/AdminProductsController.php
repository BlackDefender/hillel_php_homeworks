<?php

class AdminProductsController extends BaseController
{
    public static function products()
    {
        $products = ProductsRepo::getProducts();
        PageBuilder::build('products', ['products' => $products]);
    }

    public static function product()
    {
        $params = [];
        if(isset($_GET['id'])){
            if(empty($_POST)) {
                $product = ProductsRepo::getProductById($_GET['id']);
                $params = ['product' => $product];
            }else{
                ProductsRepo::updateProduct($_GET['id'], $_POST);
                self::redirect('admin/product/?id='.$_GET['id']);
            }

        }elseif(!empty($_POST)){
            $id = ProductsRepo::addProduct($_POST);
            self::redirect('admin/product/?id='.$id);
        }
        PageBuilder::build('product', $params);
    }

    public static function removeProduct()
    {
        if(isset($_POST['id'])){
            ProductsRepo::removeProduct($_POST['id']);
        }
        self::redirect('admin/products/');
    }
}