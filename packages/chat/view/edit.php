<?php if ($error) {
    echo $this->template('error');
}?>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form action="/chat/edit/<?php echo $postId; ?>?" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 256" maxlength="256"><?php echo $message; ?></textarea><br />
        <button name="submit">Отправить</button>
    </form>
</div>
</div>
