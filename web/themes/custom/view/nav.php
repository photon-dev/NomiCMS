<?php if ($nav): ?>
<div class="nav">
    <ol class="flex flex-wrap">
        <li>
            <i class="icon-star-empty c-blue"></i>
        </li>
        <?php foreach ($nav as $link): ?>
        <li>
            <a href="<?php echo $link['url'] ?>" title="<?php echo $link['name'] ?>">
                <?php echo $link['name'] ?>
            </a>
        </li>
        <?php endforeach; ?>
        <li><?php echo $title; ?></li>
    </ol>
</div>
<?php endif; ?>
