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
    // Управление банами
    [
        'url' => '/apanel/ban/{num}',
        'module' => 'apanel',
        'src' => 'ban',
        'params' => [
            'userId'
        ]
    ],
    [
        'url' => '/apanel/ban_list',
        'module' => 'apanel',
        'src' => 'ban_list'
    ],
    [
        'url' => '/apanel/ban_list/{num}/{str}',
        'module' => 'apanel',
        'src' => 'ban_list',
        'params' => [
            'userId',
            'action'
        ]
    ],
];
