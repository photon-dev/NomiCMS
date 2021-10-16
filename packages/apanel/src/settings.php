<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Если не авторизован, либо не модератор или выше
 if (! $user->logger || $user->getUser()['level'] < 4) {
     go_die($container, '/');
 }

// Настроить title
$view->title = 'Настройки о системы';

// Настроить навигацию
$view->nav = [
    [
        'url' => '/apanel',
        'name' => 'Панель'
    ]
];
