<?php

class User
{
    
    public static function register($name, $email, $password)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO user (name, email, password) '
                . 'VALUES (:name, :email, :password)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $answer = $result->execute();
        
        if ($answer) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Проверяет длину имени >= 3
     * @param type $name
     * @return boolean
     */
    public static function checkName($name)
    {
        if (strlen ($name) >= 3 ) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Проверяет длину телефона >= 10 
     * @param type $phone
     * @return boolean
     */
    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Проверяет длину пароля >= 6
     * @param type $name
     * @return boolean
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Проверяет правильность ввода email
     * @param type $email
     * @return boolean
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Возвращает true или false есть ли пользователь в БД
     * @param type $name
     * @param type $password
     * @param type $email
     * @return boolean
     */
    public static function checkEsistUserInDb($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT count(*) FROM user '
                . 'WHERE email = :email ';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
                
        if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Возвращает int (id пользователя из массива or false если его нет
     * @param type $email
     * @param type $password
     * @return boolean or INT 
     */
    
    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user '
                . 'WHERE email = :email AND password = :password ';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        
        $user = $result->fetch(PDO::FETCH_ASSOC);
        
        if($user) {
            return $user['id'];
        } else {
            return false;
        }
        
    }

    /**
     * Возвращает из БД все данные по кастомеру по его email
     * @param type $email
     * @return type array
     */
    public static function getUserByIdAfterRegister($email)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM user '
                . 'WHERE email = :email';
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $userByEmail = $result->fetch();
        
        return $userByEmail;
    }

    /**
     * Запоминаем пользователя в сессию по его id
     * @param type $userId
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }
    
    /**
     * Возвращаем Id пользователя из сессии
     * else перенаправляет на user/login
     * @return type INT 
     */
    public static function checkLogged()
    {
        // 
        // Если сеесия есть, вернем индефикатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        } else {
            header("Location: /user/login");
        }
    }
    
    /**
     * Удаляем из сессии id пользователя
     * и перенаправляем на главную
     */
    public static function checkLogout()
    {
        unset($_SESSION['user']);
        header("Location: /");
    }
    
    /**
     * Проверяет наличие польщователя
     * @return boolean
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Возвращает массив данных пользоватедя по его ID
     * @param type $userId
     * @return type array
     */
    public static function getUserById($id)
    {
        $id = intval($id);
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(":id", $id, PDO::PARAM_INT);
            $result->execute();
                       
            return $result->fetch(PDO::FETCH_ASSOC);
        }
    }
    
    /**
     * Возвращает true or false Изменяет данные в БД о пользователе 
     * @param type $name
     * @param type $password
     * @param type $id
     * @return type
     */
    public static function edit($name, $password, $id)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE user '
                . 'SET name = :name, password = :password '
                . 'WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }
}