<?php foreach ($row as $news): ?>
<div class="news">
    <div>
        <span class="news_title">
            <i class="icon-megaphone c-red"></i>
            <?php echo $news['name'] ?>
            <span class="nt"><?php echo $news['date_write'] ?></span>
        </span>
        <?php echo $news['message'] ?> <br />
        </span>
    </div>
</div>
<div class="menu">
    <a href="/news/comm/<?php echo $news['uid'] ?>">
        <i class="icon-comment"></i>
        Комментарии<span><?php echo $news['comments'] ?></span>
    </a>
</div>
<hr>
<?php endforeach; ?>

<?php echo $this->template('pagination'); ?>
