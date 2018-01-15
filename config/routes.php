<?php

return [
    // Товар:
    'product/([0-9]+)' => 'product/view/$1', // actionView в ProductController
    // Категории товаров:
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex в CatalogController
    'catalog' => 'catalog/index', // actionIndex в CatalogController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory в CatalogController   
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory в CatalogController
    // Корзина:
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete в CartController
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1', // actionAddAjax в CartController
    'cart/add/([0-9]+)' => 'cart/add/$1', //ctionAdd в CartController
    'cart/checkout' => 'cart/checkout', // actionCheckout in CartController
    'cart' => 'cart/index', // actionIndex в CartController
    // О магазине:
    'about' => 'site/about', // actionAbout in SiteController 
    'contacts' => 'site/contact', // actionContact в SiteController
    // Пользователь:
    'user/register' => 'user/register', // actionRegister в UserController
    'user/login' => 'user/login', // actionLogin в UserController
    'user/logout' => 'user/logout', // actionLogout в UserController
    'cabinet/edit' => 'cabinet/edit', // actionEdit в CabinetController
    'cabinet' => 'cabinet/index', // actionIndex в CabinetController 
    // Управление товарами:    
    'admin/product/create' => 'adminProduct/create', // actionCreate in AdminProductController
    'admin/product/update/([0-9]+)' => 'adminProduct/update/$1',  // actionUpdate in AdminProductController
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1', // actionDelete in AdminProductController
    'admin/product' => 'adminProduct/index',  // actionIndex in AdminProductController
    // Управление категориями:
    'admin/category/create' => 'adminCategory/create', // actionCreate in AdminCategoryController
    'admin/category/update/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1', // actionDelete in AdminCategoryController
    'admin/category' => 'adminCategory/index', // actionIndex in AdminCategoryController
    // Управление заказами:    
    'admin/order/update/([0-9]+)' => 'adminOrder/update/$1',
    'admin/order/delete/([0-9]+)' => 'adminOrder/delete/$1',
    'admin/order/view/([0-9]+)' => 'adminOrder/view/$1',
    'admin/order' => 'adminOrder/index',
    // Админ панель:
    'admin' => 'admin/index', // actionIndex in AdminController
    // Главная страница:
    'page-([0-9]+)' => 'site/index/$1', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
];