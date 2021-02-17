<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Если авторизован
if (! $container->get('user')->logger) {
    go_die($container, '/');
}

// Скрыть контент
$view->showed = true;

// Подключить сессии, cookie
$session = $container->get('session');
$cookie = $container->get('cookie');

    // Если у в куках есть данные о пользователе
    if ($cookie->login && $cookie->password) {

        // Удалить куки
        $cookie->delete('login');
        $cookie->delete('password');

        // Уничтожить сессии
        unset($session->user);
        session_destroy();
    }

go_die($container, '/');
