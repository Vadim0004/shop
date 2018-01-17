<?php require_once ROOT . '/views/layouts/header_admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Админпанель</a></li>
                <li><a href="/admin/category">Управление категориями</a></li>
                <li class="active">Отредактировать товар</li>
            </ol>

            <form action="#" method="POST" enctype="multipart/form-data">

                <p>Название категории</p>
                <input type="text" name="name" placeholder="" value="<?php echo $category['name']; ?>">

                <p>Статус</p>
                <select name="status">
                    <option value="1" <?php if ($category['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                    <option value="0" <?php if ($category['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                </select>

                <p>Отправить форму</p>
                <input type="submit" name="submit" value="Отредактировать">


            </form>

        </div>
    </div>
</div>

<?php require_once ROOT . '/views/layouts/footer_admin.php'; ?>