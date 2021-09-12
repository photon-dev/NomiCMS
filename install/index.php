<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
define('SYS', ROOT . 'system/');
define('VER', 2.3);

require SYS . 'func.php';

?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<title>Installing NomiCMS <?php echo VER; ?></title>
<meta name="viewport" content="width=device-width" />
<link href="/design/styles/default/style.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
<style> #info {font-size: 12px; display: none; margin-bottom: 12px;} </style>
</head>
<body>
<script> function info() { document.getElementById("info").style.display = "block"} </script>
<div class="logo"><img src="/design/styles/default/img/logo.png"></div>
<?
$sod = file_get_contents(SYS . 'config/db.php');

if (file_exists(SYS . 'config/db.php') && !empty($sod)) {
	echo '<div class="error">Система уже установлена!</div><div class="menu"><a href="/"><img src="/design/styles/default/img/link.png"> Главная</a></div>';
} else {

if(isset($_GET['go'])){
	if(isset($_POST['ok'])){
		$host = $_POST['dbhost'];
		$user = $_POST['dbuser'];
		$password = $_POST['dbpass'];
		$base = $_POST['dbname'];
		$demo = $_POST['demo'];

		error_reporting(0);
		$mysqli = new mysqli($host, $user, $password, $base);
		$mysqli->set_charset('utf8mb4');

		if ($mysqli->connect_errno) {
		    echo "<div class='error'>Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "</div>";
		    echo '<div class="menu"><a href="?go"><img src="/design/styles/default/img/link.png"> Назад</a></div>';
		    echo '<div class="footer">NomiCMS / '.date('Y').'</div>';
		    exit();
		}

		if ($mysqli == TRUE) {
			chmod(SYS, 0777);
			$content = "<?php\ndefine('SERVER', '$host');\ndefine('USER', '$user');\ndefine('PASS', '$password');\ndefine('BASE', '$base');\n?>";

			file_put_contents(SYS . "config/db.php", $content);
			chmod(SYS . 'config/db.php', 0664);

			$dumpdb = file_get_contents('table.sql');
			$ext = explode('-- --------------------------------------------------------', $dumpdb);

			foreach ($ext as $creat) {
				$res = $mysqli->query(trim($creat));
				if (!$res) {
			    	echo "<div class='error'>Не удалось выполнить запрос: (" . $mysqli->errno . ") " . $mysqli->error . "</div>";
				}
			}

			if ($demo) {
				$dumpdemo = file_get_contents('demo/demo.sql');
				$ext = explode('-- --------------------------------------------------------', $dumpdemo);

				foreach ($ext as $creat) {
					$res = $mysqli->query(trim($creat));
					if (!$res) {
				    	echo "<div class='error'>[DEMO] Не удалось выполнить запрос: (" . $mysqli->errno . ") " . $mysqli->error . "</div>";
					}
				}

				foreach(array('forum', 'lib', 'zc') as $i) {
					file_put_contents(R."/files/$i/000_NOMICMS_000.rar", NULL);
				}
			}

			chmod(SYS, 0744);
			chmod(ROOT . 'files/ava', 0777);
			chmod(ROOT . 'files/zc', 0777);
			chmod(ROOT . 'files/zc/screen', 0777);
			chmod(ROOT . 'files/lib', 0777);
			chmod(ROOT . 'files/mail', 0777);
		}

		echo '<div class="success">Установка завершена!</div>' . ($demo ? '<div class="main">Вы установили демо-контент!<br>Используйте данные для входа:<br><span class="new">Логин: admin</span> <span class="new">Пароль: 1111</span></div><hr>' : NULL) . '<div class="menu"><a href="/"><img src="/design/styles/default/img/link.png"> Главная</a></div><div class="footer">NomiCMS / '.date('Y').'</div></body></html>';
		exit;
	}

echo '<div class="main">
<form action="" method="POST">
Сервер:<br /><input type="text" name="dbhost" value="localhost" /><br />
Имя пользователя:<br /><input type="text" name="dbuser" /><br />
Пароль:<br /><input type="text" name="dbpass" /><br />
База Данных:<br /><input type="text" name="dbname" /><br />
<input id="demo" type="checkbox" name="demo" value="yes">
<label for="demo" onclick="info()">установить демо-контент</label><br>
<div id="info">При включении этой опции, будут добавлены сообщения, комментарии, категории к разделам, и другой контент на ваш сайт.<br></div>
<input type="submit" name="ok" value="Продолжить" />
</form></div>';

} else {
	echo '<div class="menu"><a href="?go"><img src="/design/styles/default/img/link.png"> Установка NomiCMS</a></div>';
}

}
?>
<div class="footer">NomiCMS / <?=date('Y');?></div>
</body>
</html>
