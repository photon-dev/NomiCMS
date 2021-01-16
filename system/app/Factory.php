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
    public static function create(AppInterface $app, ContainerInterface $container)
    {
        // Загрузить исходный файл
        return function () use ($container, $app) {

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Загрузить
            $src = require PACKS . $app->getPathSource();

            // Показать
            return $src;
        };
    }
}
