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
//use Exception;

/**
 * Добавление зависимостей в контейнер
 */
return function (ContainerInterface $container) {

    // Загрузить список зависимостей
    $dies = app('dies');

    // Перебрать массив
    foreach ($dies as $dependency) {

        // Если $dependency массив получить имя, зависимость
        if (is_array($dependency)) {

            // Если имя зависимости не определёно
            if (! isset($dependency[0])) {
                throw new Exception('Не удалось установить имя зависимости, из списка dies');
            }

            // Если сама зависимость не определёна
            if (! isset($dependency[1])) {
                throw new Exception('Не удалось установить зависимость, из списка dies');
            }

            // Установить зависимость по имени
            $container->set($dependency[1], $dependency[0]);
        } else {
            // Установить зависимость
            $container->set($dependency);
        }
    }

    return null;
};
