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
    // Активация email
    [
        'url' => '/email_manager',
        'module' => 'users',
        'src' => 'email'
    ],
    [
        'url' => '/email',
        'module' => 'users',
        'src' => 'mail'
    ],
    [
        'url' => '/email/{str}',
        'module' => 'users',
        'src' => 'mail',
        'params' => [
            'action'
        ]
    ],
    [
        'url' => '/email/{str}/{str}',
        'module' => 'users',
        'src' => 'mail',
        'params' => [
            'action',
            'code'
        ]
    ],
    // Кабинет
    [
        'url' => '/panel',
        'module' => 'users',
        'src' => 'panel'
    ],
    // Пользователь
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
    // Настройки пользователя
    [
        'url' => '/settings',
        'module' => 'users',
        'src' => 'settings'
    ],
    // Загрузка аватара
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
