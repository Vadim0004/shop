<?php

class BlogController 
{
    public function actionIndex()
    {
        
        $blogList = [];
        $blogList = Blog::getBlogList(4);

        require_once(ROOT . '/views/blog/index.php');

        return true;   
    }
    
    public function actionView($idBlogNews)
    {
        $idBlogNews = intval($idBlogNews);
        
        if ($idBlogNews) {
            $oneNewsList = Blog::getBlogItemById($idBlogNews);
        }
        
        require_once ROOT . '/views/blog/view.php';
        return true;
    }
}