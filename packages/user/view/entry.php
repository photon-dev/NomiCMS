<?php
    if ($entry->error) {
        echo $this->template('error');
    }
?>
    <div class="main">
        <form action="/entry" method="POST">
            Логин:<br />
            <input type="text" name="login" value="<?php echo $entry->login ?>"/><br />
            Пароль:<br />
            <input type="password" name="password" value="<?php echo $entry->password ?>"/><br />
            <button>Войти</button>
        </form>
    </div>
    <div class="menu">
        <a href="/recovery" title="Восстановление доступа">
            <i class="icon-lock-open c-red"></i>
            Восстановление доступа
        </a>
    </div>
