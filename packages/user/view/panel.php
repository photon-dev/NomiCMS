<div class="main">
    Добро пожаловать <span class="c-blue"><?php echo $user->login; ?></span>, в кабинет
</div>
<div class="menu">
    <div class="fmenu">
        <a href="/user/id<?php echo $user->uid; ?>" title="Моя страница">
            <i class="icon-user-circle c-red"></i>
            Моя страница
        </a>
        <a href="/user/alerts" title="Оповещения">
            <i class="icon-bell c-red"></i>
            Оповещения
            <span><?php echo $count->alerts; ?></span>
            <?php if ($count->new_alerts): ?>
            <span>+ <?php echo $count->new_alerts; ?></span>
            <?php endif; ?>
        </a>
        <a href="/friends/<?php echo $user->uid; ?>" title="Друзья">
            <i class="icon-user-o c-red"></i>
            Друзья
            <span><?php echo $count->friends; ?></span>
            <?php if ($count->new_friends): ?>
            <span>+ <?php echo $count->new_friends; ?></span>
            <?php endif; ?>
        </a>
        <a href="/user/edit" title="Редактировать страницу">
            <i class="icon-pencil c-red"></i>
            Редактировать страницу
        </a>
        <a href="/user/settings" title="Настройки">
            <i class="icon-cog c-red"></i>
            Настройки
        </a>
        <a href="/leave" title="Выход">
            <i class="icon-logout c-red"></i>
            Выход
        </a>
    </div>
</div>
