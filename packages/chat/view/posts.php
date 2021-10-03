<?php if ($logger): ?>
<div class="menu">
    <a href="/chat?<?php echo $code; ?>" title="Обновить">
        <i class="icon-arrows-cw c-red"></i>
        Обновить
    </a>
</div>

<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form method="POST" name="message" action="?<?php echo $code; ?>">
        Сообщение:<br />
        <textarea name="messages" placeholder="Мах 256" maxlength="256"></textarea><br />
        <button name="submit">Отправить</button>
    </form>
</div>
<?php else: ?>
<div class="main">
    Писать сообщения могут только зарегистрированые пользователи
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
            <a class="de" href="/chat/<?php echo $post->uid; ?>/del">
                <i class="icon-trash-empty c-red"></i>
            </a>
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
