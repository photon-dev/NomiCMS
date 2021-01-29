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

/**
 * Конфигурирование
 */
return function (ContainerInterface $container) {

    // Загрузить настройки
    $config = $container->get('config.config')->pull('system/system');

    // Определить, установить среду
    if ($config['env'] == 'dev' || $config['env'] == 'product') {

        loadFile('config/boot/' . $config['env']);
        return $config;
    }

    return false;
};
