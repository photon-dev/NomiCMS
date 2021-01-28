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

// Загрузить настройки
$config = $container->get('config')->pull('config', 'system/config');

// Освободить память
unset($dependencies);

// Создать приложение
$app = new NomiApp($container);

// Получить, установить среду окружения
if ($env = $app->getEnvironment($config['env'])) {
     loadFile('config/boot/' . $env);
}  else
    die('Среда окружения не может быть определена');

// Установка временной зоны
if ($config['timezone'] != date_default_timezone_get()) {
    date_default_timezone_set($config['timezone']);
}

// Настроить приложение
$app->configure();

// Иницилизировать сессии
session_name($config['session_name']) or die('Невозможно инициализировать сессии');
session_start() or die('Невозможно инициализировать сессии');

define('sess', preg_replace('#[^a-z0-9]#i', '', session_id()));


dd (Misc::translit('Невозможно инициализировать сессии'));

//dd($app->router);

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
