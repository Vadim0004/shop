<?php

class AdminCategoryController extends AdminBase
{
    public function actionIndex()
    {
        // провереям пользователя на администратора
        self::checkAdmin();
        
        // Подтягиваем с БД категории
        $categoryList = Category::getCategoriesList();
        
        // Подключаем вид
        require_once ROOT . '/views/admin_category/index.php';
        return true;
    }
    
}