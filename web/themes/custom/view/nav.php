<?php if ($list): ?>
<nav>
    <ol class="navbar flex">
        <li>

        </li>
        <?php foreach ($list as $link): ?>
        <li>
            <a href="<?php echo $link['url'] ?>" title="<?php echo $link['name'] ?>">
                <?php echo $link['name'] ?>
            </a>
        </li>
        <?php endforeach; ?>
        <li>
            <?php echo $title; ?>
        </li>
    </ol>
</nav>
<?php endif; ?>
