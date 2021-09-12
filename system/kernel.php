<?php

require SYS . '/db_config.php';
require SYS . '/functions.php';

spl_autoload_register(function($class){
$file = __DIR__ . "/classes/{$class}.php";
if (file_exists($file)) require_once "$file";
	else die(error("Ошибка загрузки {$class} класса!"));
});

error_reporting(E_ALL);
ini_set('display_errors', 'On');

ob_start();
session_start();

$db = new DB();
$tmp = new Tmp();


$ip = Core::real_IP();
$browser = browser($_SERVER['HTTP_USER_AGENT']);


if (User::aut()) {
	$useragent = $db->guard($_SERVER['HTTP_USER_AGENT']);

	$db->query("UPDATE `users` set `date_last_entry` = '".time()."', `browser` = '".$browser."', `ip` = '".$ip."', `browser_type` = '".$useragent."'  where `id` = '".User::ID()."'");

	if (User::banned(User::ID(), true)) {
		$tmp->header('home');
		User::banned(User::ID());
		$tmp->footer();
	}

} else {

	if ($db->n_r("select id from `guests` where `ip` = '".$ip."' limit 1")) {
		$db->query("update `guests` set `browser` = '".$browser."', `time` = '".time()."' where `ip` = '".$ip."' ");
	} else {
		$db->query("insert into `guests` set `ip` = '".$ip."', `browser` = '".$browser."', `time` = '".time()."' ");
	}

}

$num = (User::settings('num') == null ? Core::config('num') : User::settings('num'));
// Фикс для двух частых warning*ов //
$page = (empty($_GET['page']) ? null : intval($_GET['page']));
$error = (empty($error) ? null : $error);


?>
