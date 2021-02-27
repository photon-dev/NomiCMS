    <div class="brand">
        <a href="/" title="Главная">
            <img class="svg" src="/themes/custom/img/nomicms.svg" alt="Nomicms">
        </a>
    </div>

    <div class="panel flex">
    <?php if ($user_logger): ?>
    <?php if ($header->user['level'] >= 2): ?>
<a class="apanel" href="/panel" title="Панель управления">
            <i class="icon-direction"></i>
        </a>
        <?php endif; ?>
<a href="/user" title="Профиль">
            <i class="icon-vcard"></i>
            Профиль
        </a>
        <a href="/user/dialogs" title="Диалоги">
            <i class="icon-comment"></i>
            Диалоги
        </a>
    <?php elseif (! $user_logger): ?>
        <a href="/entry" title="Авторизация">
            <i class="icon-lock"></i>
            Авторизация
        </a>
        <a href="/signup" title="Регистрация">
            <i class="icon-user-add"></i>
            Регистрация
        </a>
    <?php endif; ?>
</div>
