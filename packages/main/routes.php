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
        'url' => '/',
        'package' => 'main',
        'src' => 'index',
        'params' => false
    ],
    [
        'url' => '/pages',
        'package' => 'main',
        'src' => 'pages'
    ],
    [
        'url' => '/pages/bbcode',
        'package' => 'main',
        'src' => 'bbcode'
    ],
    [
        'url' => '/pages/smiles',
        'package' => 'main',
        'src' => 'smiles'
    ],
    [
        'url' => '/error',
        'package' => 'main',
        'src' => 'error'
    ],
    [
        'url' => '/error/{num}',
        'package' => 'main',
        'src' => 'error',
        'params' => [
            'errorId'
        ]
    ],
    [
        'url' => '/captcha',
        'package' => 'main',
        'src' => 'captcha'
    ]
];
