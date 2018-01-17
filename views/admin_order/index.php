<?php require_once ROOT . '/views/layouts/header_admin.php';?>
<div class="container">
    <div class="row">

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Админпанель</a></li>
                <li class="active">Управление заказвми</li>
            </ol>
        </div>

        <a href="/admin/" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить заказ</a>

        <h4>Список заказов</h4>

        <br/>

        <table class="table-bordered table-striped table">
            <tr>
                <th>Номер заказа</th>
                <th>Имя пользователя</th>
                <th>Телефон пользователя</th>
                <th>Дата Заказа</th>
                <th>Просмотр</th>
                <th>Редактирование</th>
                <th>Удаление</th>
            </tr>
            <?php foreach ($orders as $oredersItem):?>
            <tr>
                <td><?php echo $oredersItem['id'];?></td>
                <td><?php echo $oredersItem['user_name'];?></td>
                <td><?php echo $oredersItem['user_phone'];?></td>
                <td><?php echo $oredersItem['date'];?></td>
                <td><a href="/admin/order/view/<?php echo $oredersItem['id'];?>" title="Отображение"> <i class="fa fa-eye"></i></a></td>
                <td><a href="/admin/order/update/<?php echo $oredersItem['id'];?>" title="Редактировать" ><i class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="/admin/order/update/<?php echo $oredersItem['id'];?>" title="Удалить"><i class="fa fa-times"></a></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer_admin.php';?>