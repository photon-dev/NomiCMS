<?php if ($error) {
    echo $this->template('error');
}?>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form action="/chat/add?<?php echo $code; ?>" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 1024" maxlength="1024"><?php echo $message; ?></textarea><br />
        <button name="submit">Отправить</button>
    </form>
</div>
</div>
