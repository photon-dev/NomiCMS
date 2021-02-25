<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\Container\ContainerInterface;

// Добавление зависимостей в контейнер
return function (ContainerInterface $container) {

    // Достаем обьект Json из контейнер
    $json = $container->get('json')::create(TEMP, 'config/routes');

    // Проверяем создан ли кэш маршрутов
    // Если нет тогда кодом ниже парсим новый кэш
    if ($json->has()) {
        $routes = $json->open(true);

        return $routes;
    }

    // Список маршрутов
    $routes = [];

    // Сканировать пакеты
    $packages = scandir(PACKS);

    // Проходим по маршрутам
    foreach ($packages as $package) {
        // Пропустить подьемы на уровни выше, ниже
        if ($package == '.' || $package == '..') continue;

        // Путь к маршрутам каждого установленного пакета
        $path = 'packages/' . $package . '/config/routes';

        // Если файл с маршрутами не найден в пакете то пропускаем
        if (! file_exists(ROOT . $path . '.php')) {
            continue;
        }

        // Загрузить маршруты
        $list = config($path);

        // Добавить маршрут в общий список
        $routes = array_merge($routes, $list);
    }

    // Создать кэш
    $json->create($routes);

    return $routes;
};
