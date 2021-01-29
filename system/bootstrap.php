<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\Container\Container;
use System\App\NomiApp;
use System\Text\Misc;

// Если не найден загрузчик, сообщить
if (!file_exists(ROOT . 'system/autoload.php')) {
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
$config = $configure($container);

// Создать приложение
$app = new NomiApp($container);

// Настроить приложение
$app->configure();

// Установить временную зону
if ($config['timezone'] != date_default_timezone_get()) {
    date_default_timezone_set($config['timezone']);
}

// Иницилизировать сессии
session_name($config['session_name']) or die('Невозможно инициализировать сессии');
session_start() or die('Невозможно инициализировать сессии');

// Сохранить имя сессии в константу
define('sess', preg_replace('#[^a-z0-9]#i', '', session_id()));


// Освободить память
unset($dependencies, $configure, $config);
/*
// Загрузить системные настройки
$settings = $container->get('config')->pull('system/settings');

// Собрать и установить все доступные маршруты
$routes = loadFile('config/routes');

// Запустить Маршрутизатор
$router = new Router($routes($container));

// Иницилизировать Приложение
$app = new NomiApp($container, $router);

// Освободить память
unset($dependencies, $routes, $router);
*/

// Показать
return $app;
