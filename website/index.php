<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Проверить версию php
$phpVersion = phpversion();
if ($phpVersion < '7.2') {
    die('Ваша версия PHP должна быть 7.2 или выше. Текущая версия: ' . $phpVersion);
}
unset($phpVersion);

// Генерации страницы
define('NOMI_START', microtime(true));

// Используемая память
define('NOMI_MEMORY', memory_get_usage());

// Корневая директория
define('ROOT', dirname(__DIR__) . '/');

ob_start();

// Загрузить bootstrap
$app = require ROOT . 'system/bootstrap.php';

/*
// Запустить приложение
switch ($app->run()) {
     // Страница найдена
    case $app::FOUND:

        // Проверить существует ли пакет
        if ($app->hasPackage() && $app->hasSource()) {

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Загрузить вид
            $view = $container->get('view');

            // Подключить исходный файл
            require PACKS . $app->getPathSource();

            // Установить настройки загрузки
            $view->autoload['counter'] =  $autoload->counter;
            $view->autoload['timing'] =  round($autoload->timing, 6);

            $view->memory = round((memory_get_usage() - NOMI_MEMORY) / 1024);
            $view->timing = round(microtime(true) - NOMI_START, 6);

        // Если файл не найден сообщить об этом
        } else {
            echo 'Пакет либо исходный файл не найден';
            //$app->notFound('Пакет либо исходный файл не найден');
        }

    break;
    // Страница не найдена
    case $app::NOT_FOUND:
        echo 'Страница не найдена';
        //$app->notFound('Страница не найдена');
    break;
}
*/

// Создано на момент тестирования
echo '<br />' . $app->run();

echo '<br /><br />Использование память: ' . round((memory_get_usage() - NOMI_MEMORY) / 1024) . ' кб';
echo '<br />Загрузчик: ' . $autoload->counter . ' за ' . round($autoload->timing, 6);
echo '<br />Генерация: ' . round(microtime(true) - NOMI_START, 6);
