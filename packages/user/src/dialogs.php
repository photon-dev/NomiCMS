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

$view->title = 'Диалоги';

$view->put();
