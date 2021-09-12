<?php
/**
 * Маршруты модуля main
 */
return [
    // Faq
    [
        'url' => '/faq',
        'module' => 'faq',
        'src' => 'index'
    ],
    // Реклама
    [
        'url' => '/faq/ads',
        'module' => 'faq',
        'src' => 'ads'
    ],
    // ББ-коды
    [
        'url' => '/faq/bbcodes',
        'module' => 'faq',
        'src' => 'bb_codes'
    ],
    // Смайлы
    [
        'url' => '/faq/smiles',
        'module' => 'main',
        'src' => 'smiles'
    ]
];
