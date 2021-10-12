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
        <textarea name="message" placeholder="Мах 256" maxlength="256"></textarea><br />
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
<div class="messages">
    <? foreach ($posts as $post) { ?>
        <div>
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
        </div>
    <? } ?>
</div>
<?php else: ?>
<div class="main">
    Нет сообщений
</div>
<?php endif; ?>

<?php echo $this->template('pagination'); ?>
