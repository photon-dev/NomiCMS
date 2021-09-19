<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакетаd user
 */
return [
    [
        'url' => '/user',
        'package' => 'user',
        'src' => 'panel'
    ],
    [
        'url' => '/user/id{num}',
        'package' => 'user',
        'src' => 'view',
        'params' => [
            'userId'
        ]
    ],
    [
        'url' => '/user/dialogs',
        'package' => 'user',
        'src' => 'dialogs'
    ],
    [
        'url' => '/user/alerts',
        'package' => 'user',
        'src' => 'alerts'
    ],
    [
        'url' => '/user/settings',
        'package' => 'user',
        'src' => 'settings'
    ],
    [
        'url' => '/leave',
        'package' => 'user',
        'src' => 'leave'
    ],
    [
        'url' => '/sign_up',
        'package' => 'user',
        'src' => 'signup'
    ],
    [
        'url' => '/entry',
        'package' => 'user',
        'src' => 'entry'
    ],
    [
        'url' => '/recovery',
        'package' => 'user',
        'src' => 'recovery'
    ],
    [
        'url' => '/users',
        'package' => 'user',
        'src' => 'users'
    ]
];
