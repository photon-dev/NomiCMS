    <header class="header flex just-between algin-stretch">

        <a class="brand" href="/" title="Главная">
            <img class="svg" src="/themes/custom/assets/nomicms.svg" alt="Nomicms">
        </a>

        <button class="toggle" onclick="openSidebar(this)">
        </button>

        <nav class="navbar">
            <ul class="navbar_ul flex just-flex-end">
                <?php if ($user_logger): ?>
                <?php if ($header->user['level'] >= 2): ?>
                <li>
                    <a href="/panel" title="Панель управления"><i class="icon-tools"></i></a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="/journal" title="Журнал"><i class="icon-bell"></i></a>
                </li>
                <li>
                    <button class="userbar" onclick="openUserbar(this)">
                        <i class="icon-user-circle"></i>
                        <span><?php echo $header->user['login']; ?></span>
                    </button>
                    <ul class="">

                    </ul>
                </li>
                <?php elseif (! $user_logger): ?>
                <li>
                    <a href="/entry" title="Войти"><i class="icon-lock"></i></a>
                </li>
                <li>
                    <a href="/sign_up" title="Регистрация"><i class="icon-user-add"></i></a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>

</header>

<div id="userbar" class="modal">
    <nav>
        <ul>
            <li>
                <a href="#ok">
                    <i class="icon-user-circle c-blue"></i>
                    Профиль
                </a>
            </li>
            <li>
                <a href="#ok">
                    <i class="icon-cog-alt c-yellow"></i>
                    Настройки
                </a>
            </li>
            <li>
                <a href="#ok">
                    <i class="icon-logout c-red"></i>
                    Выйти
                </a>
            </li>
        </ul>
    </nav>
</div>
