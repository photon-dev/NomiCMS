<?php

// Использовать
use Nomicms\Component\Text\{
    DateTime, Misc
};

$us = $view->container->get('user');

if ($user->logger): ?>
<div class="menu">
    <a href="/chat?<?php echo $code; ?>" title="Обновить">
        <i class="icon-arrows-cw c-red"></i>
        Обновить
    </a>
</div>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form action="/chat/add?<?php echo $code; ?>" method="POST" name="form">
        Сообщение:<br />
        <textarea name="message" placeholder="Мах 1024" maxlength="1024"></textarea><br />
        <button name="submit">Отправить</button>
    </form>
</div>
<?php else: ?>
<div class="main">
    <span class="c-red">
        <i class="icon-info"></i>
        Писать сообщения могут только зарегистрированые пользователи
    </span>
</div>
<?php endif; ?>
<?php if ($posts): ?>
    <? foreach ($posts as $post): ?>
    <div class="row">
        <div class="row_user flex just-between align-start">
            <a class="avatar" href="/user/id<?php echo $post['user_uid'];?>" title="Профиль <?php echo $post['login']; ?>">
                <img src="/uploads/avatars/<?php echo $post['avatar']; ?>" alt="Alt">
            </a>
            <div class="name flex-grow1">
                <a href="/user/id<?php echo $post['user_uid']; ?>" title="Профиль <?php echo $post['login']; ?>">
                    <?php echo $post['login']; ?>
                    <span class="level <?php echo $us->getLevel($post['level']); ?>"><?php echo $us->getLevel($post['level']); ?></span>
                </a>
                <a href="/chat/reply/<?php echo $post['user_uid']; ?>">
                    <i class="icon-reply c-gray"></i>
                </a><br />
                <div>
                    <?php echo Misc::output($post['status']); ?>
                </div>
            </div>
            <div class="date">
                <?php echo DateTime::times($post['date_write']); ?>
            </div>
        </div>
    <div class="message">
        <?php echo Misc::output($post['message']); ?>
    </div>
    <!---
    <div class="message flex flex-column">
        <div class="user flex just-between align-start">
        <?php if ($post['login'] == NULL): ?>
            <span class="user">
                DELETED
            </span>
        <?php else:
            $level = $us->getLevel($post['level']);
            //$avatar = $us->getAvatar($post['avatar']);
        ?>
            <img src="/uploads/avatars/<?php echo $post['avatar']; ?>" alt="Alt">
            <a href="/user/id<?php echo $post['user_uid']; ?>" title="Профиль <?php echo $post['login']; ?>">
                <?php echo $post['login']; ?>
                <span class="level <?php echo $level; ?>"><?php echo $level; ?></span>
            </a><br />
        <?php endif; ?>
            <a href="/chat/reply/<?php echo $post['user_uid']; ?>">
                <i class="icon-reply c-gray"></i>
            </a>
            <span class="date"><?php echo DateTime::times($post['date_write']); ?></span>
        </div>
        <div class="text">
            <?php echo Misc::output($post['message']); ?>
        </div>
        <div class="ttt flex just-flex-end">
            <a href="/chat/like/<?php echo $post['uid']; ?>" title="">
                <i class="icon-thumbs-up-alt c-gray"></i>
                Мне нравиться
            </a>
            <a href="/chat/edit/<?php echo $post['uid']; ?>" title="">
                <i class="icon-pencil c-yellow"></i>
            </a>
            <a href="/chat/del/<?php echo $post['uid']; ?>" title="">
                <i class="icon-trash-empty c-red"></i>
            </a>
        </div>
    </div>

        <div class="post__row">
            <a class="user" href="/user/id<?php echo $post->user_uid; ?>" title="Профиль <?php echo $post->login; ?>">
                <i class="icon-user c-blue"></i>
                <?php echo $post->login; ?>
            </a>
            <?php if ($user->uid == $post->user_uid || $user->level >= 2): ?>
            <a class="de" href="/chat/del/<?php echo $post->uid; ?>">
                <i class="icon-trash-empty c-red"></i>
            </a>
            <?php endif; ?>
            <span class="times"><?php echo $post->date_write; ?></span>
            <a class="answer" href="/chat/reply/<?php echo $post->login; ?>">
                <i class="icon-reply c-gray"></i>
            </a><br />
            <?php echo $post->message; ?>
            <span class="flex just-flex-end">
                <a href="/chat/like/<?php echo $post->uid; ?>" title="">
                    <i class="icon-thumbs-up-alt c-gray"></i>
                    Мне нравиться
                </a>
                <a href="/chat/edit/<?php echo $post->uid; ?>" title="">
                    <i class="icon-pencil c-gray"></i>
                    Изменить
                </a>
                <a href="/chat/del/<?php echo $post->uid; ?>" title="">
                    <i class="icon-trash-empty c-gray"></i>
                    Удалить
                </a>
            </span>
        </div>
        !--->
    </div>
    <? endforeach; ?>
<?php else: ?>
<div class="main">
    Нет сообщений
</div>
<?php endif; ?>

<?php echo $this->template('pagination'); ?>
