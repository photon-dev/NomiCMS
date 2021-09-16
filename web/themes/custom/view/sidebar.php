        <aside class="sidebar flex column just-content-between">
            <nav class="sidebar_nav flex-grow1" role="navigation">
                <ul class="sidebar_menu flex column just-start">
                    <li class="title">
                        <i class="icon-angle-double-down"></i>Главное меню
                    </li>
                    <li>
                        <a class="link" href="/news" title="Новости">
                            <i class="icon-megaphone c-red"></i>
                            <span class="title">Новости</span>
                            <span class="count"><?php echo $count->news; ?></span>
                            <?php echo ($count->new_news > 0) ? '<span class="new">+' . $count->new_news . '</span>' : ''; ?>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/forum" title="Форум">
                            <i class="icon-chat-empty c-red"></i>
                            <span class="title">Форум</span>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/lib" title="Библиотека">
                            <i class="icon-box c-red"></i>
                            <span class="title">Библиотека</span>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/chat" title="Мини-чат">
                            <i class="icon-chat c-red"></i>
                            <span class="title">Мини-чат</span>
                            <span class="count"><?php echo $count->chat_message; ?></span>
                            <?php echo ($count->new_chat_message > 0 ) ? '<span class="new">+' . $count->new_chat_message . '</span>' : ''; ?>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/blogs" title="Блог">
                            <i class="icon-edit c-red"></i>
                            <span class="title">Блог</span>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/news" title="Пользователи">
                            <i class="icon-users c-red"></i>
                            <span class="title">Пользователи</span>
                            <span class="count"><?php echo $count->users; ?></span>
                            <?php echo ($count->new_users > 0) ? '<span class="new">+' . $count->new_users . '</span>' : ''; ?>
                        </a>
                    </li>
                    <li>
                        <a class="link" href="/info" title="Информация">
                            <i class="icon-info-circled c-red"></i>
                            <span class="title">Информация</span>
                        </a>
                    </li>
                <ul>
            </nav>
            <div class="sidebar_bottom">
                <a href="/local" title="Выбрать язык">
                    <i class="icon-language"></i>
                    RU
                </a>
                <a href="/online" title="Онлайн">
                    <i class="icon-globe"></i>
                    8 / 15
                </a>
            </div>
        </aside>
