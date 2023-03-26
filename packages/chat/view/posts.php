<?php if ($user->logger): ?>
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
            <img class="avatar" src="/uploads/avatars/<?php echo $post->avatar; ?>" alt="Alt">
            <div class="name flex-grow1">
                <?php if ($post->login == NULL): ?>
                    <span class="none_name">
                        Пользователь удален
                    </span>
                <?php else:?>
                    <a href="/user/id<?php echo $post->user_uid; ?>" title="Профиль <?php echo $post->login; ?>">
                        <?php echo $post->login; ?>
                        <span class="level <?php echo $post->level; ?>"><?php echo $post->level; ?></span>
                    </a>
                    <a href="/chat/reply/<?php echo $post->user_uid; ?>">
                        <i class="icon-reply c-gray"></i>
                    </a>
                    <?php if ($post->status): ?>
                    <div>
                        <?php echo $post->status; ?>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="date">
                <?php echo $post->date_write; ?>
            </div>
        </div>
        <div class="message">
            <?php echo $post->message; ?>
        </div>
        <?php if ($user->logger): ?>
        <div class="navbar flex just-flex-end">
            <a href="/chat/like/<?php echo $post->uid; ?>" title="">
                <i class="icon-thumbs-up-alt c-gray"></i>
                Мне нравиться
            </a>
            <?php if ($user->uid == $post->user_uid || $user->level > 1): ?>
            <a href="/chat/edit/<?php echo $post->uid; ?>" title="">
                <i class="icon-pencil c-yellow"></i>
            </a>
            <?php endif; ?>
            <?php if ($user->level > 1): ?>
            <a href="/chat/del/<?php echo $post->uid; ?>" title="">
                <i class="icon-trash-empty c-red"></i>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <? endforeach; ?>
<?php else: ?>
<div class="main">
    Нет сообщений
</div>
<?php endif; ?>

<?php echo $this->template('pagination'); ?>
