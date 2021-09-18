<header class="header">
    <a class="brand" href="/" title="Главная">
        <img class="svg" src="/themes/custom/assets/nomicms.svg" alt="Nomicms">
    </a>
</header>
<div class="title">
    <?php if (! $header->nav): ?>
        <i class="icon-star-empty c-blue"></i>
        <?php echo $title; ?>
    <?php else: ?>
    <!--- Навигация --->
        <?php $this->template('nav'); ?>
    <?php endif; ?>
</div>
<!--- Панель --->
<?php $this->template('panel'); ?>
