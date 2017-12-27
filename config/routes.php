<?php

return array(
    
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
     
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex в CatalogController
    'catalog' => 'catalog/index', // actionIndex в CatalogController
   
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
    'cart/add/([0-9]+)' => 'cart/add/$1', //a ctionAdd в CartController
    'cart' => 'cart/index', // actionIndex в CartController
    
    'contacts' => 'site/contact', // actionContact в SiteController

    'user/register' => 'user/register', // actionRegister в UserController
    
    'user/login' => 'user/login', // actionLogin в UserController
    'user/logout' => 'user/logout', // actionLogout в UserController
    
    'cabinet/edit' => 'cabinet/edit', // actionEdit в CabinetController
    'cabinet' => 'cabinet/index', // actionIndex в CabinetController
    
    
    'page-([0-9]+)' => 'site/index/$1', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
    
);