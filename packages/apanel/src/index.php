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
$view->title = 'Панель управления';

$view->set('index', [
    'version' => $app->getVersion(),
    'status' => $app->getStatus()
]);

// Рендерить шаблон
$view->render('index');
