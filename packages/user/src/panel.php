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

$profile = $user->getUser();

$view->title = 'Привет ' . $profile['login'];
