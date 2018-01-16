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
    
    public function actionCreate()
    {
        // провереям пользователя на администратора
        self::checkAdmin();
        
        //Если форма отправлена
        if (isset($_POST['submit'])) {
            $option['name'] = $_POST['name'];
            $option['sort_order'] = $_POST['sort_order'];
            $option['status'] = $_POST['status'];
            
            /*
            echo '<pre>';
            print_r($option);
            echo '</pre>';
             * 
             */
            
            // Флаг ошибок
            $errors = false;
            
            // Небольшая валидация формы
            if (!is_array($option) && empty($option)) {
                $errors[] = 'Ошибка';
            }
            
            if (Category::issetCategory($option['name'])) {
                $errors[] = 'Есть похожее название в базе данных, используйте другое';
            }
            
            // Если нет ошибок создаем категорию
            if ($errors == false) {
                $categoryCreate = Category::createCategory($option);
                
                if ($categoryCreate) {
                    header("Location: /admin/category");
                }
                
            }
        }
        
        require_once ROOT . '/views/admin_category/create.php';
        return true;
    }
    
    public function actionDelete($id)
    {
        // Проверяем администратор ли?
        self::checkAdmin();
        
        // подтягиваем товар из БД по id
        $categoryId = Category::getCategoryById($id);
        
        // Если отправлена форма
        if (isset($_POST['submit'])) {
            
            // Флаг ошибок
            $errors = false;
            // Удаляем категроию из БД
            if(!Category::deleteCategory($id)) {
               $errors[] = 'Еrror';
            } else {
                header("Location: /admin/category");
            }
        }
        
        require_once ROOT . '/views/admin_category/delete.php';
        return true;
    }
    
    
    public function actionUpdate($id)
    {
        // Проверяем администратор ли?
        self::checkAdmin();
        
        // Подтягиваем категорию по id из БД
        $category = Category::getCategoryById($id);
        
        // Если существует отправка формы
        if (isset($_POST['submit'])) {
            // Записываем из формы значения в переменные
            $option['name'] = $_POST['name'];
            $option['status'] = $_POST['status'];
            
            // Флаг ошибок
            $errors = false;
            
            if (!is_array($option) && empty($option)) {
                $errors[] = 'Оштибка ввода данных';
            }
            
            // Если нет ошибок тогда разрешаем редактирование категории
            if($errors == false) {
                Category::updateCategoryById($category['id'], $option);
                header("Location: /admin/category");
            }
            
        }
        
        require_once ROOT . '/views/admin_category/update.php';
        return true;
    }
    
}