<?php
/**
 * Маршруты модуля main
 */
return [
    // Главная
    [
        'url' => '/apanel',
        'module' => 'apanel',
        'src' => 'index'
    ],
    // Список новостей, и добавление новой
    [
        'url' => '/apanel/news',
        'module' => 'apanel',
        'src' => 'news'
    ],
    // Список новостей, и добавление новой
    [
        'url' => '/apanel/news/{num}/{str}',
        'module' => 'apanel',
        'src' => 'news',
        'params' => [
            'newsId',
            'action'
        ]
    ],
    // Настройки
    [
        'url' => '/apanel/settings',
        'module' => 'apanel',
        'src' => 'settings'
    ],
    // Управление контентом
    [
        'url' => '/apanel/content',
        'module' => 'apanel',
        'src' => 'content'
    ],
];
