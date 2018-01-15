<?php require_once ROOT . '/views/layouts/header_admin.php';?>
<div class="container">
    <div class="row">
        <?php if (isset($errors) && is_array($errors)):?>
        <ul>
            <?php foreach ($errors as $errorsName):?>
            <li> - <?php echo $errorsName;?></li>
            <?php endforeach;?>
        </ul>
        <?php endif;?>
        
        <h4>Удалить категорию # <?php echo $categoryId['id'];?></h4>
        <br>
        <h4>Название категории <?php echo $categoryId['name'];?></h4>
        <br>
        <?php if ($categoryId['status'] == 1): ?>
        <h4>Статус категории <?php echo 'Включена';?></h4>
        <?php else:?>
        <h4>Статус категории <?php echo 'Выключена';?></h4>
        <?php endif;?>
        </br>
        <form action="#" method="POST">
            <input type="submit" name="submit" value="Удалить">
        </form>
    </div>
</div>
<?php require_once ROOT . '/views/layouts/footer_admin.php';?>