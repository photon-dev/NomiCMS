<?php if ($foo->back): ?>
<div class="back">
    <a href="<?php echo $foo->back; ?>" title="Назад">
        <i class="icon-ccw c-gray"></i>
        Назад
    </a>
</div>
<?php endif; ?>
<div class="footer flex just-between">
    <div>
        <a href="/online">Онлайн: 1 </a> | 0<br>
        Память: <?php echo $foo->memory; ?> кб<br />
        Генерация: <?php echo $foo->timing; ?> сек
    </div>
    <div class="copy">
        &#169; <?php echo $foo->copy; ?>
    </div>
</div>
