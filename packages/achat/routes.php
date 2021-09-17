<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакета apanel
 */
return [
    // Главная
    [
        'url' => '/apanel/chat',
        'package' => 'achat',
        'src' => 'index'
    ],
    // Обзор поста
    [
        'url' => '/apanel/chat/{num}',
        'package' => 'achat',
        'src' => 'index',
        'params' => [
            'postId'
        ]
    ],
    // Действия с постами
    [
        'url' => '/apanel/chat/{num}/{str}',
        'package' => 'achat',
        'src' => 'post',
        'params' => [
            'postId',
            'action'
        ]
    ]
];
