<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Если не авторизован
if ($user->getUser()['level'] < 2) {
    go_die($container, '/');
}

// Имя страницы
$view->title = 'Админ-чат';

// Настроить навигацию
$view->nav = [
    [
        'url' => '/apanel',
        'name' => 'Панель'
    ]
];


// Рендерить шаблон
$view->render('index');
