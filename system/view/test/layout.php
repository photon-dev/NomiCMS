<!DOCTYPE html>
<html lang="ru_RU">
<head>
    <title>Главная старница</title>
</head>
<body>
    <!--- Header --->
    <?php $this->render('header', true); ?>

    <?php echo $response->content ?>

    <!--- Header --->
    <?php $this->render('header', true); ?>
</doby>
</html>
