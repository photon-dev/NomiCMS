<?php if ($pages): ?>
<!--- Пагинация --->
<div class="pagination">
    <ol class="flex flex-wrap">
<?php if ($page > 3): ?>
        <li>
            <a href="<?php echo $url ?>1" title="В начало">
                <i class="icon-angle-double-left"></i>
            </a>
        </li>
<?php endif; ?>
<?php if ($page <= $pages && $page != 1): ?>
        <li>
            <a href="<?php echo $url . ($page - 1); ?>" title="Предыдущая страница <?php echo ($page - 1); ?>">
                <i class="icon-angle-left"></i>
            </a>
        </li>
<?php endif; ?>
<?php if ($page != 1 && $page < 4): ?>
        <li>
            <a href="<?php echo $url ?>1" title="Страница 1">1</a>
        </li>
<?php elseif ($page == 1): ?>
        <li>
            <a class="active" title="Текущая страница 1">1</a>
        </li>
<?php endif; ?>

<?php for ($i = -3; $i <= 3; $i++): ?>
    <?php if (($page + $i) > 1 && ($page + $i) < $pages): ?>

        <?php if ($i != 0): ?>
        <li>
            <a href="<?php echo $url . ($page + $i); ?>" title="Страница <?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
        </li>
        <?php else: ?>
        <li>
            <a class="active" title="Текущая страница <?php echo ($page + $i); ?>"><?php echo ($page + $i); ?></a>
        </li>
        <?php endif; ?>
    <?php endif; ?>
<?php endfor; ?>
<?php if ($page != $pages && $page > ($pages - 4)): ?>
        <li>
            <a href="<?php echo $url . $pages; ?>" title="Страница <?php echo $pages; ?>"><?php echo $pages; ?></a>
        </li>
<?php elseif ($page == $pages): ?>
        <li>
            <a class="active" title="Текущая страница <?php echo $pages; ?>"><?php echo $pages; ?></a>
        </li>
<?php endif; ?>
<?php if ($page != $pages): ?>
        <li>
            <a href="<?php echo $url . ($page + 1); ?>" title="Следущая страница <?php echo ($page + 1); ?>">
                <i class="icon-angle-right"></i>
            </a>
        </li>
<?php endif; ?>
<?php if ($page < ($pages - 3)): ?>
        <li>
            <a href="<?php echo $url . $pages; ?>" title="В конец">
                <i class="icon-angle-double-right"></i>
            </a>
        </li>
<?php endif; ?>
</ol>
</div>
<?php endif; ?>
