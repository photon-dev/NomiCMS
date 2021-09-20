<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Если не авторизован, либо не модератор или выше
if (! $user->logger || $user->getUser()['level'] < 2) {
    go_die($container, '/');
}

// Имя страницы
$view->title = 'Панель управления';

$view->set('index', [
    'user' => [
        'level' => $user->getUser()['level']
    ],
    'version' => $app->getVersion(),
    'status' => $app->getStatus()
]);

// Рендерить шаблон
$view->render('index');
