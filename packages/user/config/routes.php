<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты
 */
return [
    [
        'url' => '/user/id{num}',
        'package' => 'user',
        'src' => 'view',
        'params' => [
            'userId'
        ]
    ],
    [
        'url' => '/user',
        'package' => 'user',
        'src' => 'profile'
    ],
    [
        'url' => '/user/settings',
        'package' => 'user',
        'src' => 'settings'
    ],
    [
        'url' => '/signup',
        'package' => 'user',
        'src' => 'signup'
    ],
    [
        'url' => '/entry',
        'package' => 'user',
        'src' => 'entry'
    ],
    [
        'url' => '/user/leave',
        'package' => 'user',
        'src' => 'leave'
    ]
];
