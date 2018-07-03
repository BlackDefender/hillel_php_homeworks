<?php
/**
 * Created by PhpStorm.
 * User: Black Defender
 * Date: 02.07.2018
 * Time: 20:45
 */

class OrdersRepo extends Repo
{
    public static function addOrder($user_id, $address, $payment_method_id, $message, $price)
    {
        $statement = self::connection()
            ->prepare('INSERT INTO orders (user_id, address, payment_method_id, message, price) VALUES (?, ?, ?, ?, ?)');
        $statement->execute([$user_id, $address, $payment_method_id, $message, $price]);
        return self::connection()->lastInsertId();
    }

    public static function addPurchase($order_id, $product_id, $variant_id, $amount, $price)
    {
        $statement = self::connection()
            ->prepare('INSERT INTO purchases (order_id, product_id, variant_id, amount, price) VALUES (?, ?, ?, ?, ?)');
        $statement->execute([$order_id, $product_id, $variant_id, $amount, $price]);
    }

    public static function getOrderById($id)
    {
        $statement = self::connection()->prepare('SELECT * FROM orders WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Order');
        $order = $statement->fetch();
        $order->purchases = self::getOrderPurchases($id);
        return $order;
    }

    private static function getOrderPurchases($orderId)
    {
        $statement = self::connection()->prepare('SELECT * FROM purchases WHERE order_id = :order_id');
        $statement->bindValue(':order_id', $orderId, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $purchases = $statement->fetchAll();
        foreach ($purchases as $purchase){
            $purchase->product = ProductsRepo::getProductById($purchase->product_id);
            $purchase->variant = ProductsVariantsRepo::getVariantById($purchase->variant_id);
        }
        return $purchases;
    }

}