<?php

class Product
{

    const SHOW_BY_DEFAULT = 6;

    /**
     * Returns an array of products
     */
    public static function getLatestProducts($count = self::SHOW_BY_DEFAULT, $page = 1)
    {
        $count = intval($count);
        $page = intval($page);
        $offset = ($page - 1) * $count;
        
        $db = Db::getConnection();
        $productsList = [];

        $result = $db->query('SELECT id, name, price, is_new FROM product '
                . 'WHERE status = "1"'
                . 'ORDER BY id DESC '                
                . 'LIMIT ' . $count
                . ' OFFSET '. $offset);

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }
    
    /**
     * Returns an array of products
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1)
    {
        if ($categoryId) {
            
            $page = intval($page);            
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;
        
            $db = Db::getConnection();            
            $products = array();
            $result = $db->query("SELECT id, name, price, is_new FROM product "
                    . "WHERE status = '1' AND category_id = '$categoryId' "
                    . "ORDER BY id ASC "                
                    . "LIMIT ".self::SHOW_BY_DEFAULT
                    . ' OFFSET '. $offset);

            $i = 0;
            while ($row = $result->fetch()) {
                $products[$i]['id'] = $row['id'];
                $products[$i]['name'] = $row['name'];
                $products[$i]['price'] = $row['price'];
                $products[$i]['is_new'] = $row['is_new'];
                $i++;
            }

            return $products;       
        }
    }
    
    
    /**
     * Returns product item by id
     * @param integer $id
     */
    public static function getProductById($id)
    {
        $id = intval($id);

        if ($id) {                        
            $db = Db::getConnection();
            
            $result = $db->query('SELECT * FROM product WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            return $result->fetch();
        }
    }
    
    /**
     * Returns total products
     */
    public static function getTotalProductsInCategory($categoryId)
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status="1" AND category_id ="'.$categoryId.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    
    /**
     * Возвращает количество всех продуктов
     * @return type INT
     */
    
    public static function getTotalProductsCategory()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
                . 'WHERE status="1" ORDER BY id DESC');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }
    
    /**
     * Returns an array of recommended products
     */
    public static function getRecommendedProducts()
    {
        $db = Db::getConnection();

        $productsList = array();

        $result = $db->query('SELECT id, name, price, image, is_new FROM product '
                . 'WHERE status = "1" AND is_recommended = "1"'
                . 'ORDER BY id DESC ');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productsList;
    }

    /**
     * Возвращает массив рекомендуемых продуктов
     * @param type $count
     * @return arrey 
     */
    
    public static function getRecomendProducts($count = self::SHOW_BY_DEFAULT)
    {
        $count = intval($count);
        
        if ($count) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM product '
                    . 'WHERE status = 1 AND is_recommended = 1 '
                    . 'ORDER BY id DESC '
                    . 'LIMIT :count';
            $result = $db->prepare($sql);
            $result->bindParam(':count', $count, PDO::PARAM_INT);
            $result->execute();
            
            $recomendProducts = [];
            $i = 0;
            
            while ($row = $result->fetch()) {
                $recomendProducts[$i]['id'] = $row['id'];
                $recomendProducts[$i]['name'] = $row['name'];
                $recomendProducts[$i]['code'] = $row['code'];
                $recomendProducts[$i]['price'] = $row['price'];
                $recomendProducts[$i]['brand'] = $row['brand'];
                $recomendProducts[$i]['description'] = $row['description'];
                $recomendProducts[$i]['is_new'] = $row['is_new'];
                $recomendProducts[$i]['is_recommended'] = $row['is_recommended'];
                $i++;
            }
            
            return $recomendProducts;
            
        }
        
    }
    
    public static function getProdustsByIds($idsArray)
    {
        $products = array();
        
        $db = Db::getConnection();
        
        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString) ";

        $result = $db->query($sql);        
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
   
        return $products;
    }
    
    /**
     * Возвращает массив всех продуктов из БД 
     * @return type array
     */
    public static function getProductsList()
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM product '
                . 'ORDER BY id DESC';
        $result = $db->query($sql);
        
        $products = [];
        $i = 0;
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['category_id'] = $row['category_id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['price'] = $row['price'];
            $products[$i]['availability'] = $row['availability'];
            $products[$i]['brand'] = $row['brand'];
            $products[$i]['description'] = $row['description'];
            $products[$i]['is_new'] = $row['is_new'];
            $products[$i]['is_recommended'] = $row['is_recommended'];
            $products[$i]['status'] = $row['status'];
            $i++;
        }
        
        return $products;
    }
    
    /**
     * Удаляет товар с указанным id
     * @param type $id <p>id продукта</p>
     * @return type boolean
     */
    public static function deleteProductById($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM product '
                . 'WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();   
    }
    
    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'INSERT INTO product '
                . '(name, code, price, category_id, brand, availability,'
                . 'description, is_new, is_recommended, status)'
                . 'VALUES '
                . '(:name, :code, :price, :category_id, :brand, :availability,'
                . ':description, :is_new, :is_recommended, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }
    
    /**
     * Возвращает путь к продукту
     * @param type $id <p>id продукта</p>
     * @return string
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';
        $noImagePath = '/upload/images/products/no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        } else {
            return $noImagePath;
        }
    }
}