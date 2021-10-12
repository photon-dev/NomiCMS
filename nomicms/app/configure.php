<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use Nomicms\Component\Container\ContainerInterface;

/**
 * Конфигурирование
 */
return function (ContainerInterface $container) {

    // Загрузить настройки
    $config = $container->get('config')::pull('system');

    // Определить, установить среду
    if ($config['env'] == 'dev' || $config['env'] == 'product') {

        app('boot/' . $config['env']);

        return $config;
    }

    return false;
};
