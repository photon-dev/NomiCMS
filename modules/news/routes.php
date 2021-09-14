<?php
/**
 * Маршруты модуля news
 */
return [
    // Все новости
    [
        'url' => '/news',
        'module' => 'news',
        'src' => 'index'
    ],
    // Комментарии новости
    // $newsId - id новости
    [
        'url' => '/news/{num}/comments',
        'module' => 'news',
        'src' => 'comments',
        'params' => [
            'newsId'
        ]
    ],
    // Действия с комментарием
    [
        'url' => '/news/comment/{num}/{str}',
        'module' => 'news',
        'src' => 'comment',
        'params' => [
            'commentId',
            'action'
        ]
    ]
];
