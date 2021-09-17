<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакета chat
 */
return [
    [
        'url' => '/chat',
        'package' => 'chat',
        'src' => 'index'
    ],
    [
        'url' => '/chat/reply/{str}',
        'package' => 'chat',
        'src' => 'reply',
        'params' => [
            'userName'
        ]
    ],
    [
        'url' => '/chat/{num}/{str}',
        'package' => 'chat',
        'src' => 'post',
        'params' => [
            'postId', 'action'
        ]
    ]
];
