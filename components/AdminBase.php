<?php

abstract class AdminBase
{
    /**
     * Метод проаеряет пользователя на то, является ли он фдминистратором
     * @return boolean
     */
    public static function checkAdmin()
    {
        // Провереям авторизирован ли пользователь
        $userId = User::checkLogged();
        
        // Провереям информацию о текущем пользователе
        $user = User::getUserById($userId);
        
        // Если роль пользователя admin, пускаем его
        if ($user['role'] == 'admin') {
            return true;
        } else {
            die('Access denied');
        }
    }
}