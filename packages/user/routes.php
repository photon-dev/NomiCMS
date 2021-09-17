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
        'url' => '/user/{str}',
        'package' => 'user',
        'src' => 'view',
        'params' => [
            'userLogin'
        ]
    ],
    [
        'url' => '/dialogs',
        'package' => 'user',
        'src' => 'dialogs'
    ],
    [
        'url' => '/settings',
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
