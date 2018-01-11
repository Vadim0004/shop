<?php require_once ROOT . '/views/layouts/header_admin.php';?>
<div class="container">
    <div class="row">

        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Админпанель</a></li>
                <li class="active">Управление категориями</li>
            </ol>
        </div>

        <a href="/admin/category/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить категорию</a>

        <h4>Список категорий</h4>

        <br/>

        <table class="table-bordered table-striped table">
            <tr>
                <th>Номер категории</th>
                <th>Название категории</th>
                <th>Статус</th>
                <th>Редактирование</th>
                <th>Удаление</th>
            </tr>
            <?php foreach ($categoryList as $category):?>
            <tr>
                <td><?php echo $category['id'];?></td>
                <td><?php echo $category['name'];?></td>
                
                <td>
                    <?php if ($category['status'] == 1):?>
                    <?php echo 'Включена';?>
                    <?php else:?>
                    <?php echo 'Выключена';?>
                    <?php endif;?>
                </td>     
                <td><a href="/admin/order/update/<?php echo $oredersItem['id'];?>" title="Редактировать" ><i class="fa fa-pencil-square-o"></i></a></td>
                <td><a href="/admin/order/delete/<?php echo $oredersItem['id'];?>" title="Удалить"><i class="fa fa-times"></a></td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer_admin.php';?>