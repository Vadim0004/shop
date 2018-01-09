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
    /**
     * actionUpdate обновляет информацию о выбранном товаре
     */
    public function actionUpdate($id)
    {
        // Провереям пользователя что он админ
        self::checkAdmin();
        
        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesList();
        
        require_once ROOT . '/views/admin_product/update.php';
        return true;
    }
    
    /**
     * Action для страницы "Добавить товар"
     */
    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список категорий для выпадающего списка
        $categoriesList = Category::getCategoriesList();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['code'] = $_POST['code'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            $options['brand'] = $_POST['brand'];
            $options['availability'] = $_POST['availability'];
            $options['description'] = $_POST['description'];
            $options['is_new'] = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }

            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Product::createProduct($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/product");
            }
        }
        
        require_once ROOT . '/views/admin_product/create.php';
        return true;
    }
    
}