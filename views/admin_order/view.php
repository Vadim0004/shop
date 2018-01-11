<?php require_once ROOT . '/views/layouts/header_admin.php'; ?>
<div class="container">
    <div clas="row">
        <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/order">Управление заказами</a></li>
                    <li class="active">Просмотр заказа</li>
                </ol>
            </div>


            <h4>Просмотр заказа #<?php echo $order['id']; ?></h4>
            <br/>
            
    </div>
</div>

<?php require_once ROOT . '/views/layouts/footer_admin.php'; ?>