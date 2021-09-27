<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты пакета main
 */
return [
    [
        'url' => '/info',
        'package' => 'info',
        'src' => 'index'
    ],
    [
        'url' => '/info/bbcode',
        'package' => 'info',
        'src' => 'bbcode'
    ],
    [
        'url' => '/info/emoji',
        'package' => 'info',
        'src' => 'emoji'
    ]
];
