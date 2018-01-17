<?php

class AdminOrderController extends AdminBase
{
    public function actionIndex()
    {
        // провереям пользователя на администратора
        self::checkAdmin();
        
        // получаем список заказов
        $orders = Order::getOrdersList();
        
        // Подключаем вид
        require_once ROOT . '/views/admin_order/index.php';
        return true;
    }
    
    public function actionView($id)
    {
        // провереям пользователя на администратора
        self::checkAdmin();
        
        // Подтягиваем из бд массив с id заказа
        $order = Order::getOrderById($id);
        
        // Получаем из таблицы список продуктов
        $productQuantity = json_decode($order['products'], true);

        // Получаем массив с индефикаторами товаров
        $products = array_keys($productQuantity);
        
        // Получаем список товаров по id njdfhjd bp vfccbdf
        $product = Product::getProdustsByIdsArray($products);
        
        require_once ROOT . '/views/admin_order/view.php';
        return true;
    }
    
}