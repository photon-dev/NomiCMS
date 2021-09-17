<div class="panel flex">
    <?php if ($user_logger): ?>
        <?php if ($user['level'] >= 2):?>
        <a class="apanel" href="/apanel" title="Панель управления">
            <i class="icon-shield"></i>
        </a>
        <?php endif; ?>
        <a href="/user" title="Кабинет">
            <i class="icon-user-circle"></i>Кабинет
        </a>
        <a href="/user/dialogs" title="Диалоги">
            <i class="icon-mail-alt"></i>Диалоги
        </a>
    <?php else: ?>
        <a href="/entry" title="Авторизация">
            <i class="icon-lock"></i>Авторизация
        </a>
        <a href="/sign_up" title="Регистрация">
            <i class="icon-lock-open"></i>Регистрация
        </a>
    <?php endif; ?>
</div>
