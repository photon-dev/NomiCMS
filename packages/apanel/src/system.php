<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Password;

$user = $container->get('user');

// Если не авторизован
if (! $user->logger || $user->getUser()['level'] <= 2) {
    go_die($container, '/');
}

$action = $action ?? '';

switch ($action) {
    case 'settings':

        require PACKS . 'apanel/src/system/settings.php';

        break;

    case 'about':

        require PACKS . 'apanel/src/system/about.php';

        break;

    default:
        $view->title = 'Управление системой';

        break;
}
