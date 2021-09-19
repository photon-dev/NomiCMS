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
    <link rel="shortcut icon" href="/favicon.ico" sizes="16x16" type="image/x-icon">
    <meta name="theme-color" content="#070E14">
</head>
<body id="app" class="app">
    <!--- Шапка --->
    <?php $this->template('header'); ?>

<!--- Контент --->
<?php echo $layout->content; ?>

    <!--- Ноги --->
<?php $this->template('footer'); ?>
</doby>
</html>
