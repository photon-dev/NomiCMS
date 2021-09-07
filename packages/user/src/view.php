<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$user = $container->get('user');

  // Если уже авторизован
if (! $user->logger) {
    go_die($container, '/');
}

// Имя, описание, ключевые слова
$view->title = $userLogin;
$view->description = 'Профиль пользователя ' . $userLogin;
$view->keywords = '';

$view->navbar();

if (isset($userLogin)) {
    $text = "Привет. Твой Login {$userLogin}";
}


if (isset($userId)) {
    $text = "Привет. Твой id {$userId}";
}


// Добавить данные
$view->set('user.view', $text, 'text');

// Рендерить
$view->render('user.view');
