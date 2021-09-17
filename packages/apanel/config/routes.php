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
        'url' => '/apanel/system',
        'package' => 'apanel',
        'src' => 'system'
    ],
    [
        'url' => '/apanel/system/{str}',
        'package' => 'apanel',
        'src' => 'system',
        'params' => [
            'action'
        ]
    ],
];
