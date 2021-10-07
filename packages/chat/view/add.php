<?php if ($error) {
    echo $this->template('error');
}?>
<div class="main">
    <form action="/chat/add?<?php echo $code; ?>" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 256" maxlength="256"></textarea><br />
        <button name="submit">Отправить</button>
    </form>
</div>
</div>
