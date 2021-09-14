<?php
/**
 * Маршруты модуля achat
 */
return [
    // Главная
    [
        'url' => '/apanel/chat',
        'module' => 'apanel',
        'src' => 'index'
    ],
    // Обзор поста админ-чата
    [
        'url' => '/apanel/chat/{num}',
        'module' => 'apanel',
        'src' => 'news',
        'params' => [
            'postId'
        ]
    ],
    // Действия с постами
    [
        'url' => '/apanel/chat/{num}/{str}',
        'module' => 'apanel',
        'src' => 'news',
        'params' => [
            'newsId',
            'action'
        ]
    ]
];
