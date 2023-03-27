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
if (! $user->logger) {
    go_die($container, '/chat');
}

// Индификатор сообщения
$postId = $postId ?? false;
$postId = Misc::abs($postId, $container);

// Получить db
$db = $container->get('db');

// Получить пост
$result = $db->query('SELECT user_uid FROM chat WHERE uid = "' . $postId . '" LIMIT 1');

if (! $result->num_rows) {
    error('Сообщение не найдено');
}
$post = $result->fetch_object();
$result->free();

// Удалить сообщение
if ($post->user_uid == $user->getUser()['uid'] || $user->getUser()['level'] > 1) {
    // Удалить сообщение
    $db->query('DELETE FROM chat WHERE uid = "' . $postId . '"');
}

go_die($container, '/chat');
