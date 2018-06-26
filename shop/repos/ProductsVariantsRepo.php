<?php

class ProductsVariantsRepo extends Repo
{
    public static function getVariants($productId)
    {
        $statement = self::connection()->prepare('SELECT * FROM variants WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetchAll();
    }

    public static function getVariantById($variantId)
    {
        $statement = self::connection()->prepare('SELECT * FROM variants WHERE id = :id');
        $statement->bindValue(':id', $variantId, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();
    }

    private static function addVariants($productId, $variants)
    {
        $statement = self::connection()->prepare("INSERT INTO variants (product_id, title, price, amount) VALUES (?, ?, ?, ?)");
        foreach ($variants as $v){
            $statement->execute([$productId, $v->title, $v->price, $v->amount]);
        }
    }

    private static function updateVariants($productId, $variants)
    {
        $statement = self::connection()->prepare("UPDATE variants SET title = ?, price = ?, amount = ? WHERE id = ?");
        foreach ($variants as $v){
            $statement->execute([$v->title, $v->price, $v->amount, $v->id]);
        }
    }

    private static function removeVariants($productId, $variantsIds)
    {
        $ids = implode(', ', $variantsIds);
        $statement = self::connection()->prepare('DELETE FROM variants WHERE id IN (:ids) AND product_id = :product_id');
        $statement->bindValue(':ids', $ids, PDO::PARAM_STR);
        $statement->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $statement->execute();
    }

    private static function addToVariantsArr(&$arr, &$source, $i)
    {
        $v = new stdClass();
        $v->id = $source['variant_id'][$i];
        $v->title = $source['title'][$i];
        $v->price = $source['price'][$i];
        $v->amount = $source['amount'][$i];
        $arr[] = $v;
    }

    public static function setVariants($productId, $variants)
    {
        $currentVariants = self::getVariants($productId);
        $currentVariantsIds = array_map(function ($variant){
            return $variant->id;
        }, $currentVariants);

        $add = [];
        $update = [];
        $removeIds = [];

        for($i=0; $i<count($variants['variant_id']); ++$i){
            if($variants['variant_id'][$i] == ''){
                self::addToVariantsArr($add, $variants, $i);
            }elseif (in_array($variants['variant_id'][$i], $currentVariantsIds)){
                self::addToVariantsArr($update, $variants, $i);
            }else{
                $removeIds[] = intval($variants['variant_id'][$i]);
            }
        }

        if(count($add)){
            self::addVariants($productId, $add);
        }
        if(count($update)){
            self::updateVariants($productId, $update);
        }
        if(count($removeIds)){
            self::removeVariants($productId, $removeIds);
        }
    }

    public static function removeAllProductVariants($productId)
    {
        $statement = self::connection()->prepare('DELETE FROM variants WHERE product_id = :product_id');
        $statement->bindValue(':product_id', $productId, PDO::PARAM_INT);
        $statement->execute();
    }

}