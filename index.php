<?php
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('SYS', ROOT . '/system');
define('MODS', ROOT . '/modules');

// Путь к конфиг файлу
$dbConfig = SYS . '/db_config.php';

/**
 * Ели файл конфиг найден и он пуст, либо не найден
 * Перенаправить к установке
 */
if (file_exists($dbConfig) && empty(file_get_contents($dbConfig)) || ! file_exists($dbConfig)) {
	header('location: /install/');
}
// Удалить переменную
unset($dbConfig);

/**
 * Если система уже установлена, сообщить об этом
 */
/*
if (file_exists(R."/install/index.php")) {
	echo 'Удалите папку install';
	exit();
}
*/

// Подключить ядро
require SYS . '/kernel.php';

// Подключить файл модуля по умолчанию
require MODS . '/main/src/index.php';
