<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use Website\Install\Core\Install;

// Генерации страницы, Память
define('NOMI_START', microtime(true));
define('NOMI_MEMORY', memory_get_usage());

// Корневая директория
define('ROOT', dirname(__DIR__, 2) . '/');

// Если не найден загрузчик, сообщить
if (!file_exists(ROOT . 'system/autoload.php')) {
    die('Не удалось запустить авто-загрузчик');
}

// Загрузить bootstrap
require ROOT . 'system/autoload.php';

echo 'Вас приветствует установщик Nomicms v3.0.1601b';
