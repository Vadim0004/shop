<?php

class Blog
{
    const SHOW_BY_DEFAULT = 3;
    /**
     * Возвращает массив с 1 новости из БД
     * @param integer $id <p>Id новости из БД</p>
     */
    public static function getBlogItemById($id)
    {
        $id = intval($id);

        if ($id) {
                        
            $db = Db::getConnection();
            $sql = 'SELECT * FROM blog WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->execute();
            $result->setFetchMode(PDO::FETCH_ASSOC);
            
            $blogItem = $result->fetch();

            return $blogItem;
        }
    }

    /**
     * Возвращает массив новостей из БД
     * @param type $numberItems <p>Количество новостей выводить на странице</p>
     * @return array
     */
    public static function getBlogList($numberItems = self::SHOW_BY_DEFAULT) {
 
        $db = Db::getConnection();
        
        $blogList = array();
        
        $result = $db->query('SELECT id, title, date, short_content '
                . 'FROM blog '
                . 'ORDER BY date DESC '
                . 'LIMIT ' . $numberItems);        

        $i = 0;
        while($row = $result->fetch()) {
            $blogList[$i]['id'] = $row['id'];
            $blogList[$i]['title'] = $row['title'];
            $blogList[$i]['date'] = $row['date'];
            $blogList[$i]['short_content'] = $row['short_content'];
            $i++;
        }

        return $blogList;
    }


}
