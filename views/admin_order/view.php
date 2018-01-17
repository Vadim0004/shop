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
        <table class="table-bordered table-striped table">
            <tr>
                <th>Номер заказа</th>
                <th>Имя на которое оформлен заказ</th>
                <th>Телефон пользователя</th>
                <th>Дата заказа</th>
                <th>Статус заказа</th>
                <th>Коментарий пользователя</th>
            </tr>
            <tr>
                <td><?php echo $order['id'];?></td>
                <td><?php echo $order['user_name'];?></td>
                <td><?php echo $order['user_phone'];?></td>
                <td><?php echo $order['date'];?></td>
                <td><?php Order::getNameStatusOrder($order['status']);?></td>
                <td><?php echo $order['user_comment'];?></td>
            </tr>
        </table>
        
        <h4>Список продуктов который купил пользователь</h4>
        
        <table class="table-bordered table-striped table">
            <tr>
                <th>Название продукта</th>
                <th>Стоимость продукта</th>
                <th>Количество продуктов</th>
                <th>Общая стоимость продуктов</th>
            </tr>
                <?php foreach ($product as $productId):?>
            <tr>
                <td><?php echo $productId['name'];?></td>
                <td><?php echo $productId['price'];?></td>
                <td><?php echo $productQuantity[$productId['id']];?></td>
                <td><?php echo Product::totalPriceProducts($productQuantity[$productId['id']], $productId['price']);?></td>
            </tr>
                <?php endforeach;?>
        </table>
    </div>
</div>

<?php require_once ROOT . '/views/layouts/footer_admin.php'; ?>