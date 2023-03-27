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
        'url' => '/chat/page/{num}',
        'package' => 'chat',
        'src' => 'index',
        'params' => [
            'pageId'
        ]
    ],
    [
        'url' => '/chat/add',
        'package' => 'chat',
        'src' => 'add'
    ],
    [
        'url' => '/chat/reply/{str}',
        'package' => 'chat',
        'src' => 'reply',
        'params' => [
            'userLogin'
        ]
    ],
    [
        'url' => '/chat/like/{num}',
        'package' => 'chat',
        'src' => 'like',
        'params' => [
            'postId'
        ]
    ],
    [
        'url' => '/chat/edit/{num}',
        'package' => 'chat',
        'src' => 'edit',
        'params' => [
            'postId'
        ]
    ],
    [
        'url' => '/chat/del/{num}',
        'package' => 'chat',
        'src' => 'del',
        'params' => [
            'postId'
        ]
    ]
];
