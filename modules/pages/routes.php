<?php
/**
 * Маршруты модуля pages
 */
return [
    // Faq
    [
        'url' => '/pages',
        'module' => 'pages',
        'src' => 'index'
    ],
    // Реклама
    [
        'url' => '/pages/ads',
        'module' => 'pages',
        'src' => 'ads'
    ],
    // ББ-коды
    [
        'url' => '/pages/bb_codes',
        'module' => 'pages',
        'src' => 'bbcodes'
    ],
    // Смайлы
    [
        'url' => '/pages/smile',
        'module' => 'pages',
        'src' => 'smiles'
    ]
];
