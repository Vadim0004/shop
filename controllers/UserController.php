<?php

class UserController
{
    
    public function actionRegister()
    {
        $name = false;
        $email = false;
        $password = false;
        
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            /*
            echo $name . '<br>';
            echo $email . '<br>';
            echo $password . '<br>';
             * 
             */
            
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
            
            if (User::checkEmail($email)) {
                // echo $email . '<br>';
            } else {
                $errors[] = 'Email written not correct';
            }
            
            if (User::checkEsistUserInDb($email)) {
                $errors[] = 'Вы не проходите дальше данный пользователь уже существует';
            } else {
                // echo 'Отлично вы идете дальше в БД' . '<br>';
            }
            
            // Если нет ошибок записать пользователя в БД
            if ($errors == false) {
                $create = User::register($name, $email, $password);
                // echo 'Вы зарегестированы' . '<br>';
            } else {
                // echo 'FATAL ERROR';
            }
        }

        require_once ROOT . '/views/user/register.php';
        return true;
    }
    
    public function actionLogin()
    {
        $email = false;
        $password = false;
        
        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = false;
            /*
            echo $email . '<br>';
            echo $password . '<br>';
             * 
             */
            
            if (User::checkPassword($password)) {
                // echo $password . '<br>';
            } else {
                $errors[] = 'Password must be >= 6 characters';
            }
            
            if (User::checkEmail($email)) {
                // echo $email . '<br>';
            } else {
                $errors[] = 'Email written not correct';
            }
            
            // Проверяем существует ли пользователь
            
            $userId = User::checkUserData($email, $password);
            
            if ($userId == false) {
                $errors[] = 'Not correct data you write';
            } else {
                // Если данные правильные запоминаем пользователя
                User::auth($userId);
                
                // Перенаправляем в закрытыю часть сайта
                header("Location: /cabinet/");
            }   
        }
        
        require_once ROOT . '/views/user/login.php';
        return true;
    }
    
    public function actionLogout()
    {
        User::checkLogout();
        return true;
    }
}