<?php

class CabinetController
{
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // echo $userId;
        
        // Получаеи информацию о пользователе из БД
        $userData = [];
        $userData = User::getUserById($userId);
        
        require_once ROOT . '/views/cabinet/index.php';
        return true;
    }
    
    public function actionEdit()
    {
        // Получаем id пользователя из сессии
        $userId = User::checkLogged();
        
        // Получаеи информацию о пользователе из БД
        $userData = [];
        $userData = User::getUserById($userId);
        
        $name = $userData['name'];
        $password = $userData['password'];
        
        $result = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors = false;
            
            if (User::checkName($name)) {
                // echo $name . '<br>';
            } else {
                $errors[] = 'Name must be >= 3 characters';
            }
            
            if (User::checkPassword($password)) {
                // echo $password . '<br>';
            } else {
                $errors[] = 'Password must be >= 6 characters';
            }
            
            if ($errors == false) {
                $result = User::edit($name, $password, $userId);
            } else {
                $errors[] = 'Ошибка!';
            }
        }
        
        require_once ROOT . '/views/cabinet/edit.php';
        return true;
    }
    
    public function actionHistory()
    {
        // Проверяем залогинен ли пользователь и получаем из сесси его id
        $userId = User::checkLogged();

        // Из таблицы заказов берем все его заказы по user_id
        $orders = Order::getOrdersByAuthorId($userId);
        
        require_once ROOT . '/views/cabinet/history.php';
        return true;
    }
}