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
    define('ROOT', __DIR__ . '/');
}

// Системная директория
if (! defined('SYS')) {
    define('SYS', ROOT . 'nomicms/');
}

// Powered By NomiCMS
header('X-Powered-By: NomiCMS');

// Память, Генерации страницы
define('NOMI_START', microtime(true));
define('NOMI_MEMORY', memory_get_usage());

// Файл начальной загрузки не найден
if (! file_exists(ROOT . 'nomicms/bootstrap.php')) {
    echo 'Файл начальной загрузки не найден';
    die;
}

// Подключить файл начальной загрузки NomiCMS
$app = require_once ROOT . 'nomicms/bootstrap.php';

// Запустить
$app->run();
