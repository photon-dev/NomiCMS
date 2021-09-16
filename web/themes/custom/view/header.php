    <header class="header flex just-between algin-stretch">

        <a class="brand" href="/" title="Главная">
            <img class="svg" src="/themes/custom/assets/nomicms.svg" alt="Nomicms">
        </a>

        <a class="toggle" onclick="openSidebar(this)">
        </a>

        <nav class="navbar">
            <ul class="navbar_ul flex just-flex-end">
                <?php if ($user_logger): ?>
                <li>
                    <a href="/journal" title="Журнал"><i class="icon-bell"></i></a>
                </li>
                <?php if ($header->user['level'] >= 2): ?>
                <li>
                    <a href="/panel" title="Панель управления"><i class="icon-user-secret"></i></a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="/user/<?php echo $header->user['login']; ?>" title="<?php echo $header->user['login']; ?>">
                        <i class="icon-user-circle"></i>
                        <span><?php echo $header->user['login']; ?></span>
                    </a>
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
