<?php require_once ROOT . '/views/layouts/header.php'; ?>
<div class="container">
    <div class="row">
        <h2 class="title"><a href="/blog/<?php echo $oneNewsList['id']; ?>"><?php echo $oneNewsList['title']; ?></a></h2>
        <br/>
        <p><b><?php echo '#' . $oneNewsList['id']; ?></b> at <?php echo $oneNewsList['date']; ?></p>
        <div class="entry">
            <p><?php echo $oneNewsList['content']; ?></p>
        </div>
        <div class="meta">
            <p class="links"><a href="/blog/" class="comments">Back to all news</a></p>
        </div>  
    </div>
</div>    
<?php require_once ROOT . '/views/layouts/footer.php'; ?>