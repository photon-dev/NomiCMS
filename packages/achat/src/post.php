<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$user = $container->get('user');

// Если не авторизован
if ($user->getUser()['level'] < 2) {
    go_die($container, '/');
}

// Имя страницы
$view->title = 'Админ-чат - post';

// Рендерить шаблон
$view->render('post');
