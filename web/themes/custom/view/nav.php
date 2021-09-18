<?php if ($list): ?>
<nav>
    <ol class="navbar flex wrap">
        <li>
            <i class="icon-star-empty c-blue"></i>
        </li>
        <?php foreach ($list as $link): ?>
        <li>
            <?php if ($link['url']): ?>
            <a href="<?php echo $link['url'] ?>" title="<?php echo $link['name'] ?>">
                <?php echo $link['name'] ?>
            </a>
            <?php else: ?>
            <?php echo $link['name']; ?>
            <?php endif; ?>
        </li>
        <?php endforeach; ?>
    </ol>
</nav>
<?php endif; ?>
