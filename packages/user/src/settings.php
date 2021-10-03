<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Настройки';

// Настроить навигацию
$view->nav = [
    [
        'url' => '/user',
        'name' => 'Кабинет'
    ]
];

$view->render('settings');
