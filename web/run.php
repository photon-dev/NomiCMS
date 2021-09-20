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
$app->run();
