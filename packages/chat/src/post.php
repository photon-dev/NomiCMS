<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use Nomicms\Component\Text\Misc;

// Если не авторизован
//if (! $user->logger || $user->getUser()['level'] < 2) {
if (! $user->logger) {
    go_die($container, '/');
}

// Индификатор сообщения
$postId = $postId ?? false;

// Действие
$action = $action ?? false;

// Получить db
$db = $container->get('db');

$db->query();

// Удалить сообщение
if ($action == 'del' && $user->getUser()['level'] > 2) {
    $postId = Misc::abs($postId, $container);

    // Выполнить запрос
    $db->query('DELETE FROM chat WHERE uid = "' . $postId . '"');

    dd('del');
    //go_die($container, '/chat');
}

//$view->put();
