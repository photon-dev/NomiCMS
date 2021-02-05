<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Корневая директория
 if (! defined('ROOT')) {
     define('ROOT', dirname(__DIR__) . '/');
 }

// Генерации страницы
define('NOMI_START', microtime(true));
// Используемая память
define('NOMI_MEMORY', memory_get_usage());

// Загрузить bootstrap
$app = require ROOT . 'system/bootstrap.php';

// Запустить приложение
//echo $app;
$app->run();

// Создано на момент тестирования
//echo '<br />' . $app->run();
/*
echo '<br /><br />Память: ' . round((memory_get_usage() - NOMI_MEMORY) / 1024) . ' кб';
echo '<br />Загрузчик: ' . $autoload->getCounter() . ' за ' . round($autoload->getTiming(), 6);
echo '<br />Генерация: ' . round(microtime(true) - NOMI_START, 6);
*/
