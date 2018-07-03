<?php

class AdminMainController extends BaseController
{
    public static function index()
    {
        $productsCount = ProductsRepo::getProductsCount();
        $cacheInfo = ImagesRepo::cacheInfo();
        PageBuilder::build('main', [
            'productsCount' => $productsCount,
            'cacheInfo' => $cacheInfo,
        ]);
    }

    public static function clearImagesCache()
    {
        ImagesRepo::clearCache();
        self::redirect('admin');
    }
}