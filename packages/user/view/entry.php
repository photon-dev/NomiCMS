<?php
    if ($entry->error) {
        echo $this->template('error');
    }
?>
    <div class="main">
        <form method="POST" action="/entry">
            Логин:<br />
            <input type="text" name="login" maxlength="20" value="<?php echo $entry->login ?>"/><br />
            Пароль:<br />
            <input type="password" name="password" maxlength="32" value="<?php echo $entry->password ?>"/><br />
            <input id="open_s" type="checkbox" name="remember_me" value="yes"/>
            <label for="open_s">Запомнить меня</label><br />
            <button name="submit">Войти</button>
        </form>
    </div>
    <div class="menu">
        <a href="/recovery" title="Восстановление доступа">
            <i class="icon-lock-open c-red"></i>
            Восстановление доступа
        </a>
    </div>
