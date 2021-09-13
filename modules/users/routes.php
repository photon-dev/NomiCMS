<?php
/**
 * Маршруты модуля users
 */
return [
    // Авторизация
    [
        'url' => '/login',
        'module' => 'users',
        'src' => 'login'
    ],
    // Регистрация
    [
        'url' => '/reg',
        'module' => 'users',
        'src' => 'reg'
    ],
    // Пользователи онлайн
    [
        'url' => '/online',
        'module' => 'users',
        'src' => 'online'
    ],
    // Выход из профиля
    [
        'url' => '/exit',
        'module' => 'users',
        'src' => 'exit'
    ],
    // Восстановление
    [
        'url' => '/restore',
        'module' => 'users',
        'src' => 'restore'
    ],
    // Восстановление mail
    [
        'url' => '/email_manager',
        'module' => 'users',
        'src' => 'email'
    ],
    [
        'url' => '/panel',
        'module' => 'users',
        'src' => 'panel'
    ],
    [
        'url' => '/us{num}',
        'module' => 'users',
        'src' => 'profile',
        'params' => [
            'userId'
        ]
    ],
    [
        'url' => '/us{num}/otv{num}',
        'module' => 'users',
        'src' => 'profile',
        'params' => [
            'userId',
            'otvId'
        ]
    ],
    [
        'url' => '/us{num}/delete{num}',
        'module' => 'users',
        'src' => 'delete',
        'params' => [
            'userId',
            'wallId'
        ]
    ],
    [
        'url' => '/settings',
        'module' => 'users',
        'src' => 'settings'
    ],
    [
        'url' => '/ava',
        'module' => 'users',
        'src' => 'ava'
    ],
    [
        'url' => '/people',
        'module' => 'users',
        'src' => 'people'
    ],
    [
        'url' => '/journal',
        'module' => 'users',
        'src' => 'journal'
    ],
    [
        'url' => '/edit',
        'module' => 'users',
        'src' => 'edit'
    ]
];
