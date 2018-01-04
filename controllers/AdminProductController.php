<?php

class AdminProductController extends AdminBase
{
    public function actionIndex()
    {
        // Провереям пользователя что он админ
        self::checkAdmin();
        
        // Массив товаров
        $productsList = [];
        $productsList = Product::getProductsList();
        
        require_once ROOT . '/views/admin_product/index.php';
        return true;   
    }
    
    public function actionDelete($id)
    {
        // Провереям пользователя что он админ
        self::checkAdmin();
        
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Удаляем продукт
            Product::deleteProductById($id);
            // Перенаправлянем
            header("Location: /admin/product");
        }
        
        
        require_once ROOT . '/views/admin_product/delete.php';
        return true;
    }
}