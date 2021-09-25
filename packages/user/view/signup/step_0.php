<?php if ($error): ?>
    <?php $this->template('error'); ?>
<?php elseif ($success): ?>
    <?php $this->template('success'); ?>
<?php endif; ?>
<div class="main">
    <form action="/sign_up" method="POST">
        Придумайте логин: [3-15]<br />
        <input type="text" name="login" value="<?php echo $login; ?>"/><br />
        <button><?php echo ($login) ? 'Попробовать еще' : 'Выбрать'; ?></button>
        <?php if ($success): ?>
            <button type="submit" name="next_step" value="ok">Продолжить</button>
        <?php endif; ?>
    </form>
</div>
