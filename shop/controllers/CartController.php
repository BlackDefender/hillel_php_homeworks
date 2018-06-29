<?php
class CartController extends BaseController
{

    public static function index()
    {
        $cart = CartRepo::getFullCart();
        PageBuilder::build('cart', ['cart' => $cart]);
    }
    public static function add()
    {
        $variantId = $_POST['variantId'];
        $variantAmount = CartRepo::addToCart($variantId);
        /*echo json_encode([
            'variantId' => $variantId,
            'amount' => $variantAmount,
        ]);*/
        self::redirect('');
    }
    public static function subtract()
    {

        $variantId = $_POST['variantId'];
        $variantAmount = CartRepo::subtractFromCart($variantId);
        echo json_encode([
            'variantId' => $variantId,
            'amount' => $variantAmount,
        ]);
    }
    public static function remove()
    {
        CartRepo::removeFromCart($_POST['variantId']);
    }
    public static function clear()
    {
        CartRepo::clearCart();
        self::redirect('cart/');
    }
}