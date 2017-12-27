<?php

class SiteController
{

    public function actionIndex($page = 1)
    {
        $categories = [];
        $categories = Category::getCategoriesList();

        $latestProducts = [];
        $latestProducts = Product::getLatestProducts(6, $page);
        
        $total = Product::getTotalProductsCategory();
        
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');
        
        $recomend = [];
        $recomend = Product::getRecomendProducts();
        
        /*
        echo '<pre>';
        print_r($recomend);
        echo '</pre>';
         * 
         */
        
        require_once(ROOT . '/views/site/index.php');

        return true;
    }
    
    public function actionContact()
    {
        $userEmail = false;
        $userText = false;
        
        $result = false;
        
        if (isset($_POST['submit'])) {
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = [];
            
            if (User::checkEmail($userEmail)) {
                // echo 'Все ок';
            } else {
                $errors[] = 'Не правильная почта';
            }
            
            if (User::checkName($userText)) {
                // echo 'Все ок';
            } else {
                $errors[] = 'Длина сообщения должна быть больше 3 символов';
            }
            
            if ($errors == false) {
                $adminEmail = 'vadimtestacc@gmail.com';
                $message = "Tекст: {$userText} . от {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
                $result = true;
            }
        }
        
        require_once ROOT . '/views/site/contact.php';
        return true;
    }

}
