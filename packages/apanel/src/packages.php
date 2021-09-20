<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Если не авторизован, либо не модератор или выше
if (! $user->logger || $user->getUser()['level'] < 4) {
    go_die($container, '/');
}

$view->title = 'Пакеты';
$view->css = ['panel'];

// Настроить навигацию
$view->nav = [
    [
        'url' => '/apanel',
        'name' => 'Панель'
    ]
];

// Список пакетов
$packages = [];

// Сканировать пакеты
$scandir = scandir(PACKS);
foreach ($scandir as $package) {
    // Пропустить подьемы на уровни выше, ниже
    if ($package == '.' || $package == '..') continue;

    // Пропустить модуль apanel
    //if ($package == 'apanel') continue;

    // Путь к файлу package, каждого установленного пакета
    $path = $package . '/package';

    // Если файл package не найден, то пропускаем
    if (! file_exists(PACKS . $path . '.php')) {
        continue;
    }

    // Загрузить маршруты
    $config = config($path, PACKS);

    $packages[] = $config;

    // Добавить маршрут в общий список
    //$packages = array_merge($packages, [$config]);
}

$view->set('packages', $packages, 'packages');

$view->render('packages');
