<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Если уже авторизован
if (! $user->logger) {
    go_die($container, '/');
}

// Имя, описание, ключевые слова
$view->title = 'Кабинет';
$view->desc= 'Кабинет пользователя c ником - ' . $user->getUser()['login'];
$view->keywords = 'Пользователь, кабинет, user';

// Подключиться к базе
//$db = $container->get('db');

// Рендерить
$view->render('panel');
