<?php
/**
 * Маршруты модуля main
 */
return [
    // Главная странца
    [
        'url' => '/',
        'module' => 'main',
        'src' => 'index'
    ],
    // Страницы ошибок
    [
        'url' => '/error',
        'module' => 'main',
        'src' => 'error'
    ],
    [
        'url' => '/error/{num}',
        'module' => 'main',
        'src' => 'error',
        'params' => [
            'errorId'
        ]
    ]
];
