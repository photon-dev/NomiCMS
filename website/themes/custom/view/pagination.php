<?php if ($pages): ?>
<hr />
<div class="main">
    <div class="nav flex">
    <?php if ($page > 3): ?>
        <a href="<?php echo $url ?>p=1" title="В начало">&lt;&lt;</a>
    <?php endif; ?>

    <?php if ($page != $pages): ?>
        <a href="<?php echo $url . 'p=' . ($page + 1); ?>" title="Следущая страница <?php echo ($page + 1); ?>">&gt;</a>
    <?php endif; ?>

    <?php if ($page != 1 && $page < 4): ?>
        <a href="<?php echo $url ?>p=1" title="Страница 1">1</a>
    <?php elseif ($page == 1): ?>
        <a class="active" title="Текущая страница 1">1</a>
    <?php endif; ?>

    <?php for ($i = -2; $i <= 2; $i++): ?>
        <?php if (($page + $i) > 1 && ($page + $i) < $pages): ?>

            <?php if ($i != 0): ?>
                <a href="<?php echo $url . 'p=' . ($page + $i); ?>" title="Страница <?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
            <?php else: ?>
                <a class="active" title="Текущая страница <?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
            <?php endif; ?>

        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($page != $pages && $page > ($pages - 4)): ?>
        <a href="<?php echo $url . 'p=' . $pages; ?>" title="Страница <?php echo $pages; ?>"><?php echo $pages; ?></a>
    <?php elseif ($page == $pages): ?>
        <a class="active" title="Текущая страница <?php echo $pages; ?>"><?php echo $pages; ?></a>
    <?php endif; ?>

    <?php if ($page <= $pages && $page != 1): ?>
        <a href="<?php echo $url . 'p=' . ($page - 1); ?>" title="Предыдущая страница <?php echo ($page - 1); ?>">&lt;</a>
    <?php endif; ?>

    <?php if ($page < ($pages - 3)): ?>
        <a href="<?php echo $url . 'p=' . $pages; ?>" title="В конец">&gt;&gt;</a>
    <?php endif; ?>
    </div>
</div>
<?php endif; ?>
