<?php

class OrderController extends BaseController
{
    public static function index()
    {
        $order = OrdersRepo::getOrderById($_GET['id']);
        $user = UsersRepo::getById($order->user_id);
        PageBuilder::build('order', [
            'order' => $order,
            'user' => $user,
        ]);
    }
}