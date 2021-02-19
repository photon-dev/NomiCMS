    <div class="logo">
        <a href="/" title="Главная">
        <img src="/themes/custom/img/logo.png" alt="*" /></a>
    </div>

    <div class="title">
        <img src="/themes/custom/img/title.png" alt="*" />
        <?php echo $title; ?>
    </div>

    <div class="panel flex">
        <?php if ($user_logger): ?>
        <?php if ($header->user['level'] >= 2): ?>
            <a class="apanel" href="/panel" title="Панель управления">
                <img src="/themes/custom/img/admin.png" alt="*" />
            </a>
        <?php endif; ?>
            <a href="/user" title="Профиль">
                <img src="/themes/custom/img/panel.png" alt="*" />&nbsp;Профиль
            </a>
            <a href="/dialogs" title="Диалоги">
                <img src="/themes/custom/img/mail.png" alt="*" />&nbsp;Диалоги
            </a>
        <?php elseif (! $user_logger): ?>
        <a href="/entry" title="Авторизация">
            <img src="/themes/custom/img/login.png">&nbsp;Авторизация
        </a>
        <a href="/signup" title="Регистрация"><img src="/themes/custom/img/reg.png">
            &nbsp;Регистрация
        </a>
        <?php endif; ?>
    </div>
