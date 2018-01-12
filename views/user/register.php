<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                <div class="signup-form"><!--sign up form-->
                    <h4>Регистрация на сайте</h4>

                    <?php if (isset($create)): ?>

                        <h2>
                            <?php echo ' - Вы зарегестированы' . '<br>'; ?>
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
                            <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/>
                            <input type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/>
                            <input type="submit" name="submit" class="btn btn-default" value="Регистрация" />
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