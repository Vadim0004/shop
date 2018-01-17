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
    
    /**
     * Возвращает список всех покупок массивом
     * @return array 
     */
    public static function getOrdersList()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM product_order';
        $result = $db->query($sql);
        
        $listOrders = [];
        $i = 0;
        
        while ($row = $result->fetch()) {
            $listOrders[$i]['id'] = $row['id'];
            $listOrders[$i]['user_name'] = $row['user_name'];
            $listOrders[$i]['user_phone'] = $row['user_phone'];
            $listOrders[$i]['user_comment'] = $row['user_comment'];
            $listOrders[$i]['user_id'] = $row['user_id'];
            $listOrders[$i]['date'] = $row['date'];
            $listOrders[$i]['products'] = $row['products'];
            $i++;
        }
        
        return $listOrders;
    }
    
    /**
     * Возвращает массив по номеру заказа
     * @param type $id <p>Id заказа</p>
     * @return array
     */
    public static function getOrderById($id)
    {
        $id = intval($id);
        
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM product_order '
                    . 'WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            $arrayOrders = [];
            $row = $result->fetch();
            $arrayOrders['id'] = $row['id'];
            $arrayOrders['user_name'] = $row['user_name'];
            $arrayOrders['user_phone'] = $row['user_phone'];
            $arrayOrders['user_comment'] = $row['user_comment'];
            $arrayOrders['user_id'] = $row['user_id'];
            $arrayOrders['date'] = $row['date'];
            $arrayOrders['products'] = $row['products'];
            $arrayOrders['status'] = $row['status'];
            
            return $arrayOrders;
        }
    }
}