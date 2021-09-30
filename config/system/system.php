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
    // Среда окружения
     //dev, product
    'env' => 'dev',

    // Режим отладки
    'debug' => true,

    // Обновление системы
    'update' => [
        // Статус
        'status' => false,
        // Список ip-адресов кому доступен сайт при обновлении системы
        'ips' => [
            '127.0.0.1',
            '176.124.123.19'
        ]
    ],

    // Статус сайта
    'close' => false,

    // URL-адрес
    'url' => 'nomicms.org',

    // Часовой пояс
    //'timezone' => 'UTC',
    'timezone' => 'Europe/Moscow',

    // Имя сессии
    'session_name' => 'nomi_sess',

    // Языки
    'local' => 'ru',

    // Пунктов на страницу
    'post_page' => 7,

    // Тема оформления
    'theme' => 'custom'
];
