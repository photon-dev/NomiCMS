<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\Text\Misc;

// Если не авторизован
//if (! $user->logger || $user->getUser()['level'] < 2) {
if (! $user->logger) {
    go_die($container, '/');
}

// Индификатор сообщения
$postId = $postId ?? false;
$postId = Misc::abs($postId, $container);

// Получить db, id пользователя
$db = $container->get('db');
$post = $db->query('SELECT user_uid FROM chat WHERE uid = "' . $postId . '" LIMIT 1');

if (! $post->num_rows) {
    error('Сообщение не найдено');
}
$userId = $post->fetch_assoc();

// Удалить сообщение
if ($userId['user_uid'] == $user->getUser()['uid'] || $user->getUser()['level'] > 2) {

    // Удалить сообщение
    $db->query('DELETE FROM chat WHERE uid = "' . $postId . '"');
    go_die($container, '/chat');
}
