<?php

class ProductsRepo extends Repo
{

    public static function getProductsCount()
    {
        $statement = self::connection()->prepare('SELECT count(*) as \'count\' FROM products');
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        return $statement->fetch();
    }

    private static function getProductIllustration($productId)
    {
        $statement = self::connection()->prepare('SELECT illustration FROM products WHERE id = :id');
        $statement->bindValue(':id', $productId, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $res = $statement->fetch();
        return $res->illustration;
    }

    public static function addProduct($data)
    {
        $mainIllustration = ImagesRepo::upload('main-illustration');

        $statement = self::connection()->prepare("INSERT INTO products SET title = :title, description = :description, illustration = :illustration");
        $statement->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':illustration' => $mainIllustration,
        ]);
        $id = self::connection()->lastInsertId();

        ProductsVariantsRepo::setVariants($id, $data['variants']);

        return $id;
    }

    public static function updateProduct($id, $data)
    {
        $sql = 'UPDATE products SET title = :title, description = :description ';

        $mainIllustration = ImagesRepo::upload('main-illustration');
        if(!empty($mainIllustration)){
            ImagesRepo::remove(self::getProductIllustration($id));
            $sql .= ', illustration = :illustration ';
        }

        $sql .= 'WHERE id = :id';

        $statement = self::connection()->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $statement->bindValue(':description', $data['description'], PDO::PARAM_STR);
        if(!empty($mainIllustration)){
            $statement->bindValue(':illustration', $mainIllustration, PDO::PARAM_STR);
        }
        $statement->execute();

        ProductsVariantsRepo::setVariants($id, $data['variants']);

    }

    public static function getProductById($id)
    {
        $statement = self::connection()->prepare('SELECT * FROM products WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        $product = $statement->fetch();
        $product->variants = ProductsVariantsRepo::getVariants($id);
        return $product;
    }

    public static function getProducts($limit = 100, $offset = 0)
    {
        $statement = self::connection()->prepare('SELECT * FROM products LIMIT :limit OFFSET :offset');
        $statement->bindValue(':limit', $limit, PDO::PARAM_INT);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Product');
        $products = $statement->fetchAll();
        foreach ($products as $product) {
            $product->variants = ProductsVariantsRepo::getVariants($product->id);
        }
        return $products;
    }

    public static function removeProduct($id)
    {
        // удаляем фотку
        ImagesRepo::remove(self::getProductIllustration($id));

        // удаляем варианты товара
        ProductsVariantsRepo::removeAllProductVariants($id);

        // удаляем товар
        $statement = self::connection()->prepare('DELETE FROM products WHERE id = :id');
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
}