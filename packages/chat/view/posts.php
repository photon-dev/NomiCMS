<div class="menu">
    <a href="/chat?<?php echo $chat->code; ?>" title="Обновить">
        <i class="icon-arrows-cw c-red"></i>
        Обновить
    </a>
</div><hr>
<?php echo $view->template('bbcode'); ?>
<div class="main">
    <form method="POST" name="message" action="?<?php echo$chat->code; ?>">
        Сообщение:<br />
        <input type="hidden" name="s_code" value="d4235d25e4b8ff93443089e9e3b9114e">
        <textarea name="messages" placeholder="Мах 256" maxlength="256"></textarea><br />
        <button>Отправить</button>
    </form>
</div>
<div class="messages">
    <? foreach ($chat->posts as $post) { ?>
        <hr>
        <div>
            <a class="user" href="/user/id<?php echo $post->user_uid; ?>" title="Профиль <?php echo $post->login; ?>">
                <i class="icon-user c-blue"></i>
                <?php echo $post->login; ?>
            </a>
            <a class="de" href="/chat/<?php echo $post->uid; ?>/del">
                <i class="icon-trash-empty c-red"></i>
            </a>
            <?php echo $post->message; ?>
        </div>
    <? } ?>
</div>
