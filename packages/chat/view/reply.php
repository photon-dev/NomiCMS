<?php if ($error) {
    echo $this->template('error');
}?>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form action="/chat/reply/<?php echo $post->user_login; ?>?" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 1024" maxlength="2024"><?php echo $post->message; ?></textarea><br />
        <button name="submit">Ответить</button>
    </form>
</div>
</div>
