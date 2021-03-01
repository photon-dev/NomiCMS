    <header class="header flex algin-center">

        <a class="brand" href="/" title="Главная">
            <img class="svg" src="/themes/custom/assets/nomicms.svg" alt="Nomicms">
        </a>

        <button class="toggle" onclick="openSidebar(this)">
            <span class="sr-only"></span>
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
                    <a href="/user" title="Профиль"><i class="icon-user"></i></a>
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
