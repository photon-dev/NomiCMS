<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Misc;

// Если уже авторизован
if ($container->get('user')->logger) {
    header('location: /');
    exit;
}

// Установить имя страницы
$view->title = 'Восстановление доступа';
