<div class="menu">
    <div class="main">
        <form method="POST" action="">
            Имя: <br/>
            <input type="text" name="name" value="<?php echo $us['name'] ?>"/><br/>
            Фамилия<br/>
            <input type="text" name="fname" value=""/><br/>
            Страна:<br/>
            <input type="text" name="strana" value=""/><br/>
            Город:<br/>
            <input type="text" name="gorod" value=""/><br/>
            Обо мне:<br/>
            <input type="text" name="osebe" value=""/><br/>
            Пол: <br/>
            <select name="sex">
                <option value="1" selected="selected">мужской</option>
                <option value="0" >женский</option>
            </select><br/>
            Telegram:<br/>
            <input type="text" name="tg" value=""/><br/>
            <input type="submit" name="submit" value="Сохранить" /></form>
    </div>
</div>
