<?php if ($errors): ?>
    <div class="error">
<?php foreach ($errors as $error): ?>
        <i class="icon-cancel-circled"></i>
        <?php echo $error; ?><br />
<?php endforeach; ?>
    </div>
<?php endif; ?>
