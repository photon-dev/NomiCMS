<div class="menu">
    <a href="/apanel/chat?<?php echo $rand; ?>">
        <?php echo img('refresh.png') . ' ' . Language::config('refresh'); ?>
    </a>
</div>

<?php bbcode(); ?>

<div class="main">
    <form method="POST" name="message" action="?<?php echo $rand; ?>">
        <?php $local['message']; ?>:<br/>
        <textarea name="messages" placeholder="<?php $local['placeholder']; ?>" maxlength="256"></textarea><br />
        <input type="submit" name="submit" value="<?php $local['send']; ?>" />
    </form>
</div>

<?php if (! $posts): ?>
    <div class="main">
        <?php $local['no_messages']; ?>
    </div>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <hr>
        <div>
            <?php echo $post['kto']; ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
