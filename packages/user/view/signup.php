<?php if ($error):?>
        <?php echo $this->template('error'); ?>
<?php else: ?>
    <div class="main">
        <span class="c-red">
            <i class="icon-info"></i>
            Поля помеченные * обезательны к заполнению
        </span>
    </div>
<?php endif; ?>
    <div class="main">
        <form action="/sign_up" method="POST">
            Логин: [3-20] *<br />
            <input type="text" name="login" value="<?php echo $login; ?>"/><br />
            Пароль: [6-32] *<br />
            <input type="text" name="password" value="<?php echo $password; ?>"/><br />
            Повторите пароль: *<br />
            <input type="text" name="password2" value="<?php echo $password2; ?>"/><br />
            Имя: [5-32]<br />
            <input type="text" name="name" value="<?php echo $name; ?>"/><br />
            Пол: *<br />
            <select name="gender">
                <option value="male" <?php echo ($gender == 'male' ? 'selected="selected"' : null); ?>>мужской</option>
                <option value="female" <?php echo ($gender == 'female' ? 'selected="selected"' : null); ?>>женский</option>
            </select><br />
            <img src="/captcha" alt="Verification code"><br />
            Введите проверочный код: *<br />
            <input type="text" name="code" value=""><br />
            <button name="submit">Зарегистрироваться</button>
        </form>
    </div>
