<?php

class Order
{
    public static function save($name, $phone, $comment, $userId, $products)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO product_order '
                . '(user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:name, :phone, :comment, :userId, :productsInCart)';
        
        $products = json_encode($products);
        
        $result = $db->prepare($sql);
        $result->bindParam('name', $name, PDO::PARAM_STR);
        $result->bindParam('phone', $phone, PDO::PARAM_INT);
        $result->bindParam('comment', $comment, PDO::PARAM_STR);
        $result->bindParam('userId', $userId, PDO::PARAM_INT);
        $result->bindParam('productsInCart', $products, PDO::PARAM_STR);
        
        return $result->execute();
    }
}