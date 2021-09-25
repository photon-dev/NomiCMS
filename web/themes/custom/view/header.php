<header class="header">
    <a class="brand" href="/" title="Главная">
        <img src="/themes/custom/assets/nomicms.svg" alt="Nomicms">
    </a>
</header>

<?php if ($header->nav) {
    $this->template('nav');
} else { ?>
    <div class="title">
        <i class="icon-star-empty c-blue"></i>
        <?php echo $title; ?>
    </div>
<?php } ?>


<!--- Панель --->
<?php $this->template('panel'); ?>
