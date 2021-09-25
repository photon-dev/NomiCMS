<?php if ($success): ?>
    <div class="success">
<?php foreach ($success as $text): ?>
        <i class="icon-ok"></i>
        <?php echo $text; ?>
<?php endforeach; ?>
    </div>
<?php endif; ?>
