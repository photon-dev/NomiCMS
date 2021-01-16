<!DOCTYPE html>
<html lang="ru_RU">
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no'>
	<link rel="icon" href="favicon.ico" sizes="16x16">
	<link rel="stylesheet" href="/themes/error.min.css?v<?= $time ?>"/>
	<title>NominCMS - Обнаружена ошибка</title>
</head>
<body>
	<div class="error">
		<h1>Error</h1>
		<? foreach ($errors as $error) : ?>
			<?= $error ?><br />
		<? endforeach ?>
	</div>
</body>
</html>
