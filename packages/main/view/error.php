<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name='viewport' content='width=device-width, maximum-scale=1.0, initial-scale=1.0, user-scalable=no'>
	<link rel="icon" href="favicon.ico" sizes="16x16">
	<link rel="stylesheet" href="/themes/app.min.css?v<?= $time ?>"/>
	<title>NomiCMS - 404, <?= $error ?></title>
</head>
<body>
	<div class="app">
		<div class="app-404">
			404
		</div>
		<div class="app-error">
			<p><?= $error ?></p>
			<a href="/" title="На главную">Вернуться на главную</a>
		</div>
	</div>
</body>
</html>
