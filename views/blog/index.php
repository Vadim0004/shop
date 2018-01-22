<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="page">
    <div class="container">
        <div class="row">
            <?php foreach ($blogList as $blogItem): ?>
                <div class="post">
                    <h2 class="title"><a href="/blog/<?php echo $blogItem['id']; ?>"><?php echo $blogItem['title']; ?></a></h2>
                    <p class="byline"><?php echo $blogItem['date']; ?></p>
                    <div class="entry">
                        <p><?php echo $blogItem['short_content']; ?></p>
                    </div>
                    <div class="meta">
                        <p class="links"><a href="/blog/<?php echo $blogItem['id']; ?>" class="comments">Read more</a></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>        
    </div>
    <?php require_once ROOT . '/views/layouts/footer.php'; ?>