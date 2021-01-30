<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\App;

// Использовать
use System\Container\ContainerInterface;
use System\App\AppInterface;

/**
 * Класс Factory
 */
class Factory
{
    // Если проложение уже запущено
    protected static $app;

    // Создать фабрику
    public static function create(AppInterface $app, ContainerInterface $container)//: NomiApp
    {
        // Загрузить исходный файл
        return function () use ($container, $app) {

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Запустить шаблонизатор
            $view = $container->get('view.view');

            // Загрузить
            $src = require PACKS . $app->getPathSource();

            // Установить настройки загрузки
            $view->autoload['counter'] =  NOMI_AUTOLOAD_COUNTER;
            $view->autoload['timing'] =  round(NOMI_AUTOLOAD_TIMING, 6);

            $view->memory = round((memory_get_usage() - NOMI_MEMORY) / 1024);
            $view->timing = round(microtime(true) - NOMI_START, 6);

            // Показать
            return $src;
        };
    }
}
