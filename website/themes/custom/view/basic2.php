<!DOCTYPE html>
<html lang="<?= $response->local_html ?>">
<head>
    <title><?= $response->title ?></title>
    <meta charset="utf-8">
    <meta http-equiv="Cache-Control" content="private">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name='viewport' content='width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no'>
    <meta name="description" content="<?= $response->description ?>">
    <meta name="keywords" content="<?= $response->keywords ?>">

    <link rel="stylesheet" href="/themes/custom/css/style.min.css?8423 ?> /">

    <link rel="icon" href="/themes/custom/favicon.ico" sizes="16x16">
</head>
<body>
    <div class="logo">
        <a href="/" title="Главная">
        <img src="/themes/custom/img/logo.png" alt="*" /></a>
    </div>

    <?php $response->view->view('header', true, true); ?>

    <?php $response->view->view('index'); ?>

    <?php $response->content; ?>

    <?php $response->view->view('footer', true, true); ?>

    <div class="footer">
        <a href="/" title="Онлайн">Онлайн: 1 </a> | 0<br />
        Память: <?= $response->memory ?> кб<br />
        Генерация: <?= $response->timing ?> сек
    </div>
</doby>
</html>
