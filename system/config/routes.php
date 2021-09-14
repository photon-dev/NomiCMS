<?php
// Добавление зависимостей в контейнер
return function () {
    // Инициализировать класс Json
    //$json = Json::create(TEMP, 'config/routes');

    // Проверяем создан ли кэш маршрутов
    // Если нет тогда кодом ниже парсим новый кэш
    //if ($json->has()) {
        //$routes = $json->open(true);

        //return $routes;
    //}

    // Список маршрутов
    $routes = [];

    // Сканировать пакеты
    $modules = scandir(MODS);

    // Проходим по маршрутам
    foreach ($modules as $module) {
        // Пропустить подьемы на уровни выше, ниже
        if ($module == '.' || $module == '..') continue;

        // Путь к файлу со списокм маршрутов каждого модуля
        $path = MODS . $module . '/routes';

        // Если файл с маршрутами не найден в пакете то пропускаем
        if (! file_exists($path . '.php')) {
            continue;
        }

        // Загрузить маршруты
        $list = require $path . '.php';//config($path);

        // Добавить маршрут в общий список
        $routes = array_merge($routes, $list);
    }

    // Создать кэш
    //$json->create($routes);

    return $routes;
};
