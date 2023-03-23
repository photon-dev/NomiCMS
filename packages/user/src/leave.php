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
        if ($cookie->token) {
            // Удалить куки
            $cookie->delete('token');
        }

        // Если у в сессиях есть данные
        if ($session->token) {
            // Удалить сессии
            unset($session->token);
        }

        // Уничтожить сессии
        session_destroy();
}

go_die($container, '/');
