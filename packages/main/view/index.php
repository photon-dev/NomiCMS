<div class="menu">
    <div class="fmenu">
        <a href="/news" title="Новости">
            <i class="icon-megaphone c-blue"></i>
            Новости
            <span><?php echo $count['news']; ?></span>
            <?php if ($count['new_news']): ?>
            <span>+ <?php echo $count['new_news']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/chat" title="Мини-чат">
            <i class="icon-chat c-green"></i>
            Мини-чат
            <span><?php echo $count['chat_message']; ?></span>
            <?php if ($count['new_chat_message']): ?>
            <span>+ <?php echo $count['new_chat_message']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/forum" title="Форум">
            <i class="icon-forumbee c-red"></i>
            Форум
        </a>
        <a href="/users" title="Пользователи">
            <i class="icon-users c-yellow"></i>
            Пользователи
            <span><?php echo $count['users']; ?></span>
            <?php if ($count['new_users']): ?>
            <span>+ <?php echo $count['new_users']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/info" title="Информация">
            <i class="icon-info-circled c-red"></i>
            Информация
        </a>
    </div>
</div>
