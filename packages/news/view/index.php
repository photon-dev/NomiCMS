<?php foreach ($row as $news): ?>
<div class="news">
    <div>
        <span class="news_title">
            <?php echo $news['name'] ?>
            <span class="nt"><?php echo $news['date_write'] ?></span>
        </span>
        <?php echo $news['message'] ?> <br />
        </span>
    </div>
</div>
<div class="menu">
    <a href="/news/comm/<?php echo $news['uid'] ?>">
        <img src="/themes/custom/img/com.png" alt="*">Комментарии<span><?php echo $news['comments'] ?></span>
    </a>
</div>
<hr>
<?php endforeach; ?>
<span class="emoji-sad"></span>

<?php echo $this->template('pagination'); ?>
