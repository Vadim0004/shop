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
        
        require_once ROOT . '/views/admin_order/view.php';
        return true;
    }
    
}