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
use System\Router\Router;
use System\App\NomiApp;

// Если не найден загрузчик, сообщить
if (!file_exists(ROOT . 'system/autoload.php')) {
    die('Не удалось запустить авто-загрузчик');
}

// Подключить загрузчик
require ROOT . 'system/autoload.php';

// Создать контейнер
$container = new Container;


// Загрузить, установить службы
$dependencies = loadFile('config/dependencies');
$dependencies($container);

// Освободить память
unset($dependencies);

// Собрать и установить все доступные маршруты
$routes = loadFile('config/routes');
$routes = $routes($container);

// Запустить маршрутизатор
$router = new Router($routes);

// Создать приложение
$app = new NomiApp($container, $router);

// Загрузить системные настройки
$settings = $container->get('config')->pull('config', 'system/config');

// Получить, установить среду окружения
if ($env = $app->getEnvironment($settings['env'])) {
     loadFile('config/boot/' . $env);
}  else
    die('Среда окружения не может быть определена');

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
