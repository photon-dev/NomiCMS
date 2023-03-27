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
    <div class="post">
        <div class="post_header flex just-between align-start">
            <div class="post_avatar">
                <img src="/uploads/avatars/<?php echo $post->avatar; ?>" alt="Alt">
            </div>
            <div class="post_user flex-grow1">
                <a href="/user/id<?php echo $post->user_uid; ?>" title="Профиль <?php echo $post->login; ?>">
                    <?php echo $post->login; ?>
                    <span class="level <?php echo $post->level; ?>"><?php echo $post->level; ?></span>
                </a>
                <div class="post_date">
                    <?php echo $post->date_write; ?>
                </div>
            </div>
            <div class="post_admin">
                <a href="/chat/edit/<?php echo $post->uid; ?>" title="Изменить"><i class="icon-pencil c-gray"></i></a>
                <a href="/chat/del/<?php echo $post->uid; ?>" title="Удалить"><i class="icon-trash-empty c-red"></i></a>
            </div>
        </div>
        <div class="post_message">
            <?php echo $post->message; ?>
        </div>
        <div class="post_footer">
            
        </div>
    </div>
    <? endforeach; ?>
<?php else: ?>
<div class="main">
    Нет сообщений
</div>
<?php endif; ?>

<?php echo $this->template('pagination'); ?>
