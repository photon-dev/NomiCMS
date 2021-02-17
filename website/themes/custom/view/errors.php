<?php if ($errors): ?>
    <div class="error">
<?php foreach ($errors as $error): ?>
        <?php echo $error; ?><br />
<?php endforeach; ?>
    </div>
<?php endif; ?>
