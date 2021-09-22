<?php
    if ($sign->error) {
        echo $this->template('errors');
    }
?>
    <div class="main">
        <color class="c-red">
            <i class="icon-info"></i>
            Поля помеченные * обезательны к заполнению
        </color>
    </div><hr>
    <div class="main">
        <form action="/entry" method="POST">
            Логин: [3-15] *<br />
            <input type="text" name="login" value="<?php echo $sign->login ?>"/><br />
            Пароль: [5-32] *<br />
            <input type="password" name="password" value="<?php echo $sign->password ?>"/><br />
            Повторите пароль:*<br />
            <input type="password" name="password" value="<?php echo $sign->passwordRepeat ?>"/><br />
            Имя:<br />
            <input type="password" name="password" value="<?php echo $sign->name ?>"/><br />
            Пол:<br />
            <select name="sex">
                <option value="1">мужской</option>
                <option value="0">женский</option>
            </select><br />
            Введите код картинки:<br />
            <img src="/captcha" alt="Captcha"><br />
            <input type="text" name="code" value="<?php echo $sign->code ?>"><br />
            <button>Регистрация</button>
        </form>
    </div>
