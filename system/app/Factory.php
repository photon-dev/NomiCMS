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
use System\Response\Response;

/**
 * Класс Factory
 */
class Factory
{
    // Если проложение уже запущено
    protected static $app;

    // Создать фабрику
    public static function create(AppInterface $app, ContainerInterface $container)
    {
        // Загрузить исходный файл
        return function ($autoload) use ($app, $container) {

            //$user = $container->get('packages.user.component.user');

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Запустить шаблонизатор
            //$view = $container->get('view.view');

            // Загрузить файл источник
            require PACKS . $app->getPathSource();

            // Установить загрузки
            //$view->autoload['counter'] =  $autoload->counter;
            //$view->autoload['timing'] =  round($autoload->timing, 6);
            //$view->memory = round((memory_get_usage() - NOMI_MEMORY) / 1024);
            //$view->timing = round(microtime(true) - NOMI_START, 6);

            // Показать
            //return $response->send();
        };
    }
}
