<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <h1>Cabinet Customer</h1>
            <h3><?php echo 'Hello ' . $userData['name'];?></h3>
            <ul>
                <li><a href="/cabinet/edit">Edit Data</a></li>
                <li><a href="/cabinet/history">List of purchase</a></li>
            </ul>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>