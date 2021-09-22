<?php if ($success): ?>
    <div class="success">
<?php foreach ($success as $text): ?>
        <i class="icon-cancel-circled"></i>
        <?php echo $text; ?>
<?php endforeach; ?>
    </div>
<?php endif; ?>
