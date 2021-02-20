<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакета news
 */
return [
    [
        'url' => '/news',
        'package' => 'news',
        'src' => 'index'
    ],
    [
        'url' => '/news/{num}',
        'package' => 'news',
        'src' => 'view',
        'params' => [
            'newsId'
        ]
    ],
    [
        'url' => '/news/{num}/{str}',
        'package' => 'news',
        'src' => 'news',
        'params' => [
            'newsId', 'action'
        ]
    ],
    [
        'url' => '/news/add',
        'package' => 'news',
        'src' => 'add'
    ]
];
