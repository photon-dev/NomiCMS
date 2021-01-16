<div class="main_page">
    <? foreach ($main as $post) { ?>
        <a class="" hreh="<?= $post->url ?>" title="<?= $post->name ?>">
            <div class="counter">
                <?= $post->count ?>
            </div>
            <div class="name">
                <?= $post->name ?><br />
            </div>
        </a>
    <? } ?>
</div>
