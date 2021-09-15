<?php
/**
 * Маршруты модуля admin_chat
 */
return [
    // Главная
    [
        'url' => '/apanel/chat',
        'module' => 'achat',
        'src' => 'index'
    ],
    // Обзор поста
    [
        'url' => '/apanel/chat/{num}',
        'module' => 'achat',
        'src' => 'index',
        'params' => [
            'postId'
        ]
    ],
    // Действия с постами
    [
        'url' => '/apanel/chat/{num}/{str}',
        'module' => 'achat',
        'src' => 'post',
        'params' => [
            'postId',
            'action'
        ]
    ]
];
