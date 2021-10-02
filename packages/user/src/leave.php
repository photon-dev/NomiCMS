<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Если авторизован
if ($user->logger) {
    // Подключить сессии, cookie
    $session = $container->get('session');
    $cookie = $container->get('cookie');

        // Если у в куках есть данные
        if ($cookie->login && $cookie->password) {
            // Удалить куки
            $cookie->delete('login');
            $cookie->delete('password');
        }

        // Если у в сессиях есть данные
        if ($session->login && $session->password) {
            // Удалить сессии
            unset($session->login, $session->password);
        }

        // Уничтожить сессии
        session_destroy();
}

go_die($container, '/');
