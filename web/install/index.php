<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
//use Web\Install\Core\Install;

// Корневая директория
if (! defined('ROOT')) {
    define('ROOT', dirname(__DIR__, 2) . '/');
}

// Генерации страницы
define('NOMI_START', microtime(true));
// Используемая память
define('NOMI_MEMORY', memory_get_usage());

// Загрузить bootstrap
//$app = require ROOT . 'system/bootstrap.php';

// Запустить приложение
//$app->run();

echo 'Вас приветствует установщик Nomicms v3.0.1601b';
