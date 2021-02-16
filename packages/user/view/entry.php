<div class="title">
    <img src="/themes/custom/img/title.png" alt="*" />
    Авторизация
</div>

<?php if ($errors): ?>
    <div class="error">
<?php foreach ($errors as $error): ?>
    <?php echo $error; ?><br />
<?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="main">
    <form action="/entry" method="POST">
        Логин:<br />
        <input type="text" name="login" value"<?php echo $login; ?>"/><br />
        Пароль:<br />
        <input type="password" name="password" value"<?php echo $password; ?>"/><br />
        Введите код с картинки:<br />
        <img src="/captcha" alt="Captcha" /><br />
        <input type="text" name="code" value"<?php echo $code; ?>"/><br />
        <button>Войти</button>
        <!--- <input class="button" type="submit" value="Войти" name="submit" />--->
    </form>
</div>
<hr /><div class="menu">
    <a href="/" title="Восстановление">
        <img src="/themes/custom/img/settings.png" alt="*" />
        Восстановление
    </a>
</div>
