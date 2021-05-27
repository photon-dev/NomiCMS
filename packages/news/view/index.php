<?php foreach ($row as $news): ?>
<div class="rows">
    <div class="red">
        <div class="title">
            <i class="icon-megaphone c-red"></i>
            <span class="name"><?php echo $news['name'] ?></span>
            <span class="count"><?php echo $news['date_write'] ?></span>
        </div>
        <div class="msg">
            <?php echo $news['message'] ?>
        </div>
    <div class="other">
        <a href="/news" title="Ознакомиться">
    </div>
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
