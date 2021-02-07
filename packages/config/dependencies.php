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
 * Добавление служб в контейнер
 */
return function (ContainerInterface $container) {

    // Загрузить список служб
    $services = loadFile('config/services');

    // Установить
    foreach ($services as $service) {
        $container->set($service);
    }

    return null;
};
