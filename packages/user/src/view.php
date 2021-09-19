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
if (! $user->logger) {
    go_die($container, '/');
}

$userId = $userId ?? false;

// Имя, описание, ключевые слова
$view->title = $userId;
$view->desc= 'Профиль пользователя ' . $userId;
$view->keywords = '';


$text = "Привет. Твой id {$userId}";


// Добавить данные
$view->set('user.view', $text, 'text');

// Рендерить
$view->render('user.view');
