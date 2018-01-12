<?php

class Category
{

    /**
     * Returns an array of categories
     */
    public static function getCategoriesList()
    {

        $db = Db::getConnection();

        $categoryList = array();

        $result = $db->query('SELECT id, name, status FROM category '
                . 'ORDER BY sort_order ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }

        return $categoryList;
    }
    
    /**
     * Добавляет запись новой категории в БД
     * @param array $array <p>Массив параметров из формы</p>
     * @return boolean
     */
    public static function createCategory($array)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO category (name, sort_order, status) '
                . 'VALUES (:name, :sort_order, :status)';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $array['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $array['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $array['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            return true;
        } else {
            return false;
        }
        
    }
    
    /**
     * Проверяет есть ли идентичное название категории в БД
     * @param type $nameCategory <p>Название категории из формы</p>
     * @return boolean
     */
    public static function issetCategory($nameCategory)
    {
       $db = Db::getConnection();
       $sql = 'SELECT count(*) FROM category '
               . 'WHERE name = :nameCategory';
       $result = $db->prepare($sql);
       $result->bindParam(':nameCategory', $nameCategory, PDO::PARAM_STR);
       $result->execute();
       
       if ($result->fetchColumn()) {
            return true;
        } else {
            return false;
        }
    }

}