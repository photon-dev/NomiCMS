<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon-Dev
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 /*
  * Системные настройки
  */
return [
    // Имя сайта
    'name' => 'Nomicms',

    // Режим разработки
     //dev, product
    'env' => 'dev',

    // Режим отладки
    'debug' => true,

    // Статус сайта
    'close' => false,

    // Обновление
    'update' => [
        'status' => false,
        'ip' => []
    ],

    // URL-адрес
    'url' => 'http://nomicms.org',

    // Часовой пояс
    //'timezone' => 'UTC',
    'timezone' => 'Europe/Moscow',

    // Языки
    'local' => 'ru',

    // Пакет
    'package' => 'main'

    // Пунктов на страницу
    'post_page' => 10
];
