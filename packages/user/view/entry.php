<?php
    if ($entry->error) {
        echo $this->template('errors');
    }
?>
    <div class="main">
        <form action="/entry" method="POST">
            Логин:<br />
            <input type="text" name="login" value="<?php echo $entry->login ?>"/><br />
            Пароль:<br />
            <input type="password" name="password" value="<?php echo $entry->password ?>"/><br />
            Введите код с картинки:<br />
            <img src="/captcha" alt="Captcha" /><br />
            <input type="text" name="code" value="<?php echo $entry->code; ?>"/><br />
            <button>Войти</button>
        </form>
    </div><hr />
    <div class="menu">
        <a href="/recovery" title="Восстановление доступа">
            <i class="icon-lock-open c-red"></i>
            Восстановление доступа
        </a>
    </div>
