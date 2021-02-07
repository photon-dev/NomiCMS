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
        return function () use ($app, $container) {

            // Получить зависимость response
            $response = $container->get('response');

            // Запустить вид
            $view = $container->get('view');

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Запустить шаблонизатор
            //$view = $container->get('view.view');

            // Загрузить файл источник
            require PACKS . $app->getPathSource();

            //$view->memory = round((memory_get_usage() - NOMI_MEMORY) / 1024);
            //$view->timing = round(microtime(true) - NOMI_START, 6);
            $view->put();

            //dd($response);

            // Показать
            return $response->send();
        };
    }
}
