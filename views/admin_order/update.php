<?php require_once ROOT . '/views/layouts/header_admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="/admin">Админпанель</a></li>
                <li class="active">Управление заказвми</li>
                <li class="active">Отредактировать заказ</li>
            </ol>
        </div>

        <?php if (isset($errors) && is_array($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <ul>
                    <li><?php echo $error; ?></li>
                </ul>
            <?php endforeach; ?>
        <?php endif; ?>
        <h4>Номер заказа <?php echo '# ' . $id;?></h4>
        <div class="col-lg-4">
            <div class="login-form">
                <form action="#" method="POST">
                    <p>Имя заказчика</p>
                    <input type="text" name="user_name" value="<?php echo $ordersItem['user_name']; ?>">

                    <p>Телефон заказчика</p>
                    <input type="text" name="user_phone" value="<?php echo $ordersItem['user_phone']; ?>">

                    <p>Коментарий заказчика</p>
                    <input type="text" name="user_comment" value="<?php echo $ordersItem['user_comment']; ?>">

                    <p>Статус заказа</p>
                    
                    <select name="status">
                        <option value="1" <?php if ($ordersItem['status'] == 3) echo ' selected="selected"'; ?>><?php echo Order::getNameStatusOrder($ordersItem['status']);?></option>
                        <option value="1" <?php if ($ordersItem['status'] == 2) echo ' selected="selected"'; ?>><?php echo Order::getNameStatusOrder($ordersItem['status']);?></option>
                        <option value="1" <?php if ($ordersItem['status'] == 1) echo ' selected="selected"'; ?>><?php echo Order::getNameStatusOrder($ordersItem['status']);?></option>
                        <option value="0" <?php if ($ordersItem['status'] == 0) echo ' selected="selected"'; ?>><?php echo Order::getNameStatusOrder($ordersItem['status']);?></option>
                    </select>

                    <br></br>

                    <input type="submit" name="submit" value="Отредактировать">

                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer_admin.php'; ?>