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
    [
        'url' => '/apanel',
        'package' => 'apanel',
        'src' => 'index'
    ],
    [
        'url' => '/apanel/about',
        'package' => 'apanel',
        'src' => 'about'
    ],
    [
        'url' => '/apanel/settings',
        'package' => 'apanel',
        'src' => 'settings'
    ],
    [
        'url' => '/apanel/packages',
        'package' => 'apanel',
        'src' => 'packages'
    ],
    [
        'url' => '/apanel/package/{str}',
        'package' => 'apanel',
        'src' => 'package',
        'params' => [
            'package'
        ]
    ],
    [
        'url' => '/apanel/seo',
        'package' => 'apanel',
        'src' => 'seo'
    ],
];
