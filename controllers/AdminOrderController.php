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
    
    public function actionUpdate($id)
    {
        // Провереям пользователя что он админ
        self::checkAdmin();
        
        //Подтягиваем данные о заказе с БД
        $ordersItem = Order::getOrderById($id);
        

        //Если форма отправлена
        if (isset($_POST['submit'])) {
            // Записываем данные из формы
            $option['user_name'] = $_POST['user_name'];
            $option['user_phone'] = $_POST['user_phone'];
            $option['user_comment'] = $_POST['user_comment'];
            $option['status'] = $_POST['status'];
            
            //инициализация ошибок
            $errors = [];
            
            //Валидация формы
            if(!User::checkPhone($option['user_phone'])) {
                $errors[] = 'Длина телефона должна быть > 10 символов';
            }
            // Если ошибок нет отредактирум БД с заказми
            if ($errors == false) {
                $result = Order::updateOrder($id, $option);
                // Перенаправляем на страницу заказы
                header("Location: /admin/order");
            }
            
        }
        
        require_once ROOT . '/views/admin_order/update.php';
        return true;
    }
    
}