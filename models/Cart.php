<?php

class Cart
{
    public static function addProduct($id)
    {
        $id = intval($id);
        
        // Пустой массив для товаров в корзине
        $productsInCart = [];
        
        // Если в корзине уже есть товары (они хранятся в сессии)
        if (isset($_SESSION['products'])) {
            // То заполним наш массив товарами
            $productsInCart = $_SESSION['products'];
        }
        
        // Если товар есть в корзине, но был добавлен еще раз, увеличим количество
        if (array_key_exists($id, $productsInCart)) {
            $productsInCart[$id] ++;
        } else {
            // Добавляем новый товар в корзину
            $productsInCart[$id] = 1;
        }
        
        $_SESSION['products'] = $productsInCart;
        
        /*
        echo '<pre>';
        print_r($_SESSION['products']);
        die();
         * 
         */
        return self::countItems();
    }
    
    public static function countItems()
    {
        if (isset($_SESSION['products'])) {
            $count = 0;
            foreach ($_SESSION['products'] as $id => $quantity) {
                $count = $count + $quantity;
            }
            return $count;
        } else {
            return 0;
        }
    }
    
    public static function getProducts()
    {
        if (isset($_SESSION['products'])) {
            return $_SESSION['products'];
        } else {
            return false;
        }
    }
    
    public static function getTotalPrice($products)
    {
        $productsInCart = self::getProducts();
        
        $total = 0;
        
        if ($productsInCart) {
            foreach ($products as $item) {
                $total += $item['price'] *$productsInCart[$item['id']];
            }
        }
        
        return $total;
    }
    
    /**
    * Удаляет товар с указанным id из корзины
    * @param integer $id <p>id товара</p>
    */
    public static function deleteProduct($id)
    {
        // Получаем массив с идентификатором и количеством товаров в корзине
        $productsInCart = self::getProducts();
        
        // Удаляем из массива элемент с укзаным id
        unset($productsInCart[$id]);
        
        // Записываем массив товаров с удаленным элементом в сессию
        $_SESSION['products'] = $productsInCart;
    }
    
    /**
     * Удаляем из сессии $_SESSION['products']
     */
    public static function clear()
    {
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
        }
    }
}