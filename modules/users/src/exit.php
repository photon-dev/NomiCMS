<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SYS', ROOT . '/system');

require_once(ROOT . '/system/kernel.php');

if(!User::aut()){
	go_exit();
}

setcookie('id', '', (time()-3600), '/');
setcookie('login', '', (time()-3600), '/');
setcookie('password', '', (time()-3600), '/');
session_destroy();
unset($_SESSION['id']);
unset($_SESSION['login']);
unset($_SESSION['password']);
go_exit();
?>
