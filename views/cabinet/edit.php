<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <div class="signup-form"><!--sign up form-->
                    <h2>Редактирование данных</h2>

                    <?php if (!$result == false): ?>

                        <h2>
                            <?php echo ' - Вы поменяли свои данные' . '<br>'; ?>
                        </h2>

                    <?php else: ?>

                        <?php if (isset($errors) && is_array($errors)): ?>
                            <?php foreach ($errors as $error): ?>
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li> - <?php echo $error; ?></li>
                                </ul>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <form action="#" method="post">
                            <input type="name" name="name" placeholder="Name" value="<?php echo $name; ?>"/>
                            <input type="password" name="password" placeholder="Password" value="<?php echo $password; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Edit" />
                        </form>

                    <?php endif; ?>

                </div><!--/sign up form-->
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>