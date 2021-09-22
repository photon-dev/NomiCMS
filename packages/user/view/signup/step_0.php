<?php if ($error): ?>
    <?php $this->template('error'); ?>
<?php elseif (! $error): ?>
    <?php $this->template('success'); ?>
<?php endif; ?>
<div class="main">
    <form action="/sign_up" method="POST">
        Придумайте логин: [3-15]<br />
        <input type="text" name="login" value="<?php echo $login; ?>"/><br />
        <button>Проверить</button>
        <button type="submit" name="next_step" value="ok">Продолжить</button>
    </form>
</div>
