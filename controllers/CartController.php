<?php

class CartController
{
    
    public function actionAdd($id)
    {
        // Добавляем товар в корзину
        Cart::addProduct($id);
        
        // Возвращаем пользователя на страницу 
        $referrer = $_SERVER['HTTP_REFERER'];
        header("Location: $referrer");
        echo $id;
        return true;
    }
    
    public function actionAddAjax($id)
    {
        // добавляем товар в корзину
        echo Cart::addProduct($id);
        return true;
    }
    
    public function actionIndex()
    {
        $categories = [];
        $categories = Category::getCategoriesList();
        
        $productsInCart = false;
        // Получим данные из корзины
        $productsInCart = Cart::getProducts();
        
        if ($productsInCart) {
            // Получкаем полную информацию о товарах для списка
            $productIds = array_keys($productsInCart);

            $products = Product::getProdustsByIds($productIds);
            
            // Получаем общую стоимость
            $totalPrice = Cart::getTotalPrice($products);
        }
        
        require_once ROOT . '/views/cart/index.php';
        return true;
    }
    
    public function actionDelete($id)
    {
        Cart::deleteProduct($id);
        header("Location: /cart/");
    }
}