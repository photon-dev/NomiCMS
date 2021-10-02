<div class="menu">
    <div class="fmenu">
        <a href="/news" title="Новости">
            <i class="icon-megaphone c-gray"></i>
            Новости
            <span><?php echo $count['news']; ?></span>
            <?php if ($count['new_news']): ?>
            <span>+ <?php echo $count['new_news']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/chat" title="Мини-чат">
            <i class="icon-chat c-gray"></i>
            Мини-чат
            <span><?php echo $count['chat_message']; ?></span>
            <?php if ($count['new_chat_message']): ?>
            <span>+ <?php echo $count['new_chat_message']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/forum" title="Форум">
            <i class="icon-forumbee c-gray"></i>
            Форум
        </a>
        <a href="/users" title="Пользователи">
            <i class="icon-users c-gray"></i>
            Пользователи
            <span><?php echo $count['users']; ?></span>
            <?php if ($count['new_users']): ?>
            <span>+ <?php echo $count['new_users']; ?></span>
            <?php endif; ?>
        </a>
        <a href="/info" title="Информация">
            <i class="icon-info-circled c-gray"></i>
            Информация
        </a>
    </div>
</div>
