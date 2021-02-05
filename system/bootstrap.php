<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\App\App;
use System\Container\ContainerInterface;
use System\Container\Container;
use System\App\NomiApp;
use System\Config\Config;

if (!function_exists('dd')) {
    function dd($dd)
    {
        return var_dump($dd);
    }
}

// Проверить текущаю версию php
if (version_compare(PHP_VERSION, '7.2.2', 'lt')) {
    die(
        'Требуется PHP 7.2.2++. <br /> Текущая версия: '
        . phpversion()
    );
}

// Если файл автоматической загрузки не найден, вывести сообщение об ошибке
if (! file_exists(ROOT . 'system/autoload.php')) {
    die('Не удалось запустить авто-загрузчик');
}

// Подключить загрузчик
require ROOT . 'system/autoload.php';

// Создать контейнер
$container = new Container;

// Загрузить, установить зависимости
$dependencies = loadFile('config/dependencies');
$dependencies($container);

// Конфигурирование
$configure = loadFile('config/configure');
$system = $configure($container);


/*

// Конфигурирование
$configure = loadFile('config/configure');
$system = $configure($container);

// Установить временную зону
if ($system['timezone'] != date_default_timezone_get()) {
    date_default_timezone_set($system['timezone']);
}

// Иницилизировать сессии
session_name($system['session_name']) or die('Невозможно инициализировать сессии');
session_start() or die('Невозможно инициализировать сессии');

// Сохранить имя сессии в константу
define('sess', preg_replace('#[^a-z0-9]#i', '', session_id()));

// Время хранить в константе
define('TIME', time());

// Освободить память
unset($dependencies, $configure, $system);

// Создать приложение
$app = new NomiApp($container);

// Настроить приложение
$app->configure();
*/

// Показать
return 'Hello World';//$app;
