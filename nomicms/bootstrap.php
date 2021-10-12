<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use Nomicms\Component\Container\Container;
use Nomicms\Component\App\NomiApp;

// Проверить текущаю версию php
if (PHP_VERSION_ID < 70329) {
    die(
        'Требуется PHP 7.3.29++<br />Текущая версия: '
        . phpversion()
    );
}

// Файл автоматической загрузки не найден
if (! file_exists(ROOT . 'nomicms/autoload.php')) {
    die('Не удалось запустить авто-загрузчик');
}

// Подключить загрузчик
require ROOT . 'nomicms/autoload.php';;

// Создать контейнер
$container = new Container;

// Загрузить, установить зависимости
$dependencies = app('dependencies');
$dependencies($container);

// Конфигурирование
$configure = app('configure');
$system = $configure($container) or die('Не удалось установить среду окружения.');

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

// Показать
return $app;
