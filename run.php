<?php
// Корневая директория
if (! defined('ROOT')) {
    define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/');
}

// Используемая память
define('USE_MEMORY', memory_get_usage());

// Подключить ядро
require ROOT . 'system/kernel.php';


// Путь к конфиг файлу
//$dbConfig = ROOT . 'system/db_config.php';
/**
 * Ели файл конфиг найден и он пуст, либо не найден
 * Перенаправить к установке
 */
 /*
if (file_exists($dbConfig) && empty(file_get_contents($dbConfig)) || ! file_exists($dbConfig)) {
	header('location: /install/');
}
// Удалить переменную
unset($dbConfig);
*/

/**
 * Если система уже установлена, сообщить об этом
 */
/*
if (file_exists(R."/install/index.php")) {
	echo 'Удалите папку install';
	exit();
}
*/

// Получить маршруты
$routes = require_once SYS . 'config/routes.php';
$router = new Routing($routes());

//$route = $router->run();

var_dump($router);

// Подключить файл модуля по умолчанию
//require ROOT . '/modules/main/src/index.php';


echo '<br /><br />Память: ' . round((memory_get_usage() - USE_MEMORY) / 1024) . ' кб';
echo '<br />Генерация: ' . round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 6);
