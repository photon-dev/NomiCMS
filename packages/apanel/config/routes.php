<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Маршруты модуля apanel
 */
return [
    [
        'url' => '/panel',
        'package' => 'apanel',
        'src' => 'index'
    ],
    [
        'url' => '/panel/entry',
        'package' => 'apanel',
        'src' => 'entry'
    ]
];
