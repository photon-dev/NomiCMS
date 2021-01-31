<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Проверить версию php
$phpVersion = phpversion();
if ($phpVersion < '7.2') {
    die('Ваша версия PHP должна быть 7.2 или выше. Текущая версия: ' . $phpVersion);
}
unset($phpVersion);

// Генерации страницы
define('NOMI_START', microtime(true));

// Используемая память
define('NOMI_MEMORY', memory_get_usage());

// Корневая директория
define('ROOT', dirname(__DIR__) . '/');

// Загрузить bootstrap
$app = require ROOT . 'system/bootstrap.php';

// Запустить приложение
$app->run($autoload);

// Создано на момент тестирования
//echo '<br />' . $app->run();
/*
echo '<br /><br />Использование память: ' . round((memory_get_usage() - NOMI_MEMORY) / 1024) . ' кб';
echo '<br />Загрузчик: ' . NOMI_AUTOLOAD_COUNTER . ' за ' . round(NOMI_AUTOLOAD_TIMING, 6);
echo '<br />Генерация: ' . round(microtime(true) - NOMI_START, 6);
*/
