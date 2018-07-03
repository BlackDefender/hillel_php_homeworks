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
        self::changeAmount('add');
    }

    public static function subtract()
    {
        self::changeAmount('subtract');
    }

    private static function changeAmount($action)
    {
        $variantId = $_POST['variantId'];
        if ($action === 'add') {
            $variantAmount = CartRepo::addToCart($variantId);
        } else {
            $variantAmount = CartRepo::subtractFromCart($variantId);
        }
        $cart = CartRepo::getCart();
        echo json_encode([
            'variantId' => $variantId,
            'amount' => $variantAmount,
            'variantTotalPrice' => $cart->purchases[$variantId]->price * $variantAmount,
            'totalProducts' => $cart->totalProducts,
            'totalPrice' => $cart->totalPrice,
        ]);
    }

    public static function remove()
    {
        CartRepo::removeFromCart($_POST['variantId']);
        self::redirect('cart/');
    }

    public static function clear()
    {
        CartRepo::clearCart();
        self::redirect('cart/');
    }

    public static function submit()
    {
        $cart = CartRepo::getCart();
        $user = UsersRepo::getUserByEmail($_POST['email']);
        if (empty($user)) {
            $user = UsersRepo::autoRegister($_POST['name'], $_POST['email']);
        }

        $orderId = OrdersRepo::addOrder($user->id, $_POST['address'], $_POST['payment-method'], $_POST['message'],
            $cart->totalPrice);
        foreach ($cart->purchases as $variantId => $p) {
            $variant = ProductsVariantsRepo::getVariantById($variantId);
            OrdersRepo::addPurchase($orderId, $variant->product_id, $variantId, $p->amount, $variant->price);
        }
        CartRepo::clearCart();
        self::redirect('order/?id=' . $orderId);
    }
}