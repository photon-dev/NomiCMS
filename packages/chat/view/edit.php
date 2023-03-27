<?php if ($error) {
    echo $this->template('error');
}?>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form action="/chat/edit/<?php echo $post->post_uid; ?>?" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 1024" maxlength="2024"><?php echo $post->message; ?></textarea><br />
        <button name="submit">Изменить</button>
    </form>
</div>
</div>
