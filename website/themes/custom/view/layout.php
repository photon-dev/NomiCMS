<!DOCTYPE html>
<html lang="<?php echo $layout->local; ?>">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="private">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name='viewport' content='width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no'>
    <meta name="description" content="<?php echo $layout->desc; ?>">
    <meta name="keywords" content="<?php echo $layout->keywords; ?>">

    <!--- Stylesheets --->
    <link rel="stylesheet" href="/themes/reset.css?<?php echo $layout->style[0]; ?>"/>
    <link rel="stylesheet" href="/themes/app.css?<?php echo $layout->style[1]; ?>"/>
    <link rel="stylesheet" href="/themes/custom/css/emoji.css?<?php echo $layout->style[2]; ?>"/>
    <!---<link rel="stylesheet" href="/themes/custom/css/animation.css"/>--->
    <link rel="stylesheet" href="/themes/custom/css/fontello.css?<?php echo $layout->style[3]; ?>"/>
    <link rel="stylesheet" href="/themes/custom/css/icons.css?<?php echo $layout->style[4]; ?>"/>
    <link rel="stylesheet" href="/themes/custom/css/style.css?<?php echo $layout->style[5]; ?>"/>
    <link rel="icon" href="/themes/custom/favicon.ico" sizes="16x16">
    <meta name="theme-color" content="#070E14">
</head>
<body id="app" class="app flex column just-between">

    <!--- Шапка --->
<?php $this->template('header'); ?>

    <!--- Контент --->
    <div class="content flex just-flex-end">

        <!--- Боковая панель --->
<?php $this->template('sidebar'); ?>

        <!--- Главный --->
        <main class="main">
            <?php echo $layout->content; ?>
        </main>
    </div>

    <!--- Ноги --->
<?php $this->template('footer'); ?>

<script src="/themes/custom/js/app.js"></script>
</doby>
</html>
