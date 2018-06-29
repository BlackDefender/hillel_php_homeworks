<?php

class CartRepo
{
    private static $cartFieldName = 'cart';

    private static function getEmptyCart()
    {
        $cart = new stdClass();
        $cart->totalProducts = 0;
        $cart->totalPrice = 0;
        $cart->purchases = [];
        return $cart;
    }

    public static function getCart()
    {
        if(!isset($_SESSION[self::$cartFieldName])){
            $_SESSION[self::$cartFieldName] = self::getEmptyCart();
        }
        return $_SESSION[self::$cartFieldName];
    }

    public static function getFullCart()
    {
        $cart = self::getCart();
        foreach ($cart->purchases as $variantId => $purchase){
            $purchase->variant = ProductsVariantsRepo::getVariantById($variantId);
            $purchase->product = ProductsRepo::getProductById($purchase->variant->product_id);
        }
        return $cart;
    }

    public static function addToCart($variantId)
    {
        $cart = self::getCart();
        $variant = ProductsVariantsRepo::getVariantById($variantId);
        if(!isset($cart->purchases[$variantId])){
            $cart->purchases[$variant->id] = new stdClass();
            $cart->purchases[$variant->id]->amount = 0;
        }

        if($cart->purchases[$variantId]->amount + 1 <= $variant->amount){
            ++$cart->purchases[$variantId]->amount;
            ++$cart->totalProducts;
            $cart->totalPrice += $variant->price;
        }
        return $cart->purchases[$variant->id]->amount;
    }

    public static function subtractFromCart($variantId)
    {
        $cart = self::getCart();
        $variant = ProductsVariantsRepo::getVariantById($variantId);
        if(!isset($cart->purchases[$variantId]) && $cart->purchases[$variantId]->amount > 0){
            --$cart->purchases[$variantId]->amount;
            --$cart->totalProducts;
            $cart->totalPrice -= $variant->price;
            return $cart->purchases[$variantId]->amount;
        }else{
            return 0;
        }
    }

    public static function removeFromCart($variantId)
    {
        $cart = self::getCart();
        $variant = ProductsVariantsRepo::getVariantById($variantId);
        $cart->totalProducts -= $cart->purchases[$variantId]->amount;
        $cart->totalPrice -= $variant->price * $cart->purchases[$variantId]->amount;
        unset($cart->purchases[$variantId]);
    }

    public static function clearCart()
    {
        $_SESSION[self::$cartFieldName] = self::getEmptyCart();
    }
}