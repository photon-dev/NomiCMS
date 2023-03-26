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
use Nomicms\Component\Http\Server\Server;

// Если не авторизован
if (! $user->logger) {
    go_die($container, '/');
}

// Индификатор сообщения
$postId = $postId ?? false;
$postId = Misc::abs($postId, $container);

// Получить db
$db = $container->get('db');

// Получить пост
$result = $db->query('SELECT user_uid, message FROM chat WHERE uid = "' . $postId . '" LIMIT 1');

if (! $result->num_rows) {
    error('Сообщение не найдено');
}

$post = $result->fetch_object();
$result->free();

// Удалить сообщение
if ($post->user_uid != $user->getUser()['uid'] || $user->getUser()['level'] < 2) {
    go_die($container, '/chat');
}

// Настроить seo
$view->title = 'Редактирование сообщения';

// Настроить навигацию
$view->nav = [
    [
        'url' => '/chat',
        'name' => 'Мини-чат'
    ]
];

// Получить request, error
$request = $container->get('request')->post;
$error = $container->get('error');

// Post submit
if ($request->has('submit')) {

    // Cообщение не введно
    if ($request->em('message')) {
        $error->set('Введите сообщение');
    } elseif (strlen($request->message) > 1024) {
        $error->set('Неверная длина сообщения. Допустимо макс 1024 символов');
    }

    // Нет ощибок
    if (! $error->show()) {
        $message =  Misc::str($request->message, $container);

        // Выполнить запрос
        $db->query('UPDATE chat SET message = "' . $message . '", date_edit = "' . TIME . '" WHERE uid = "' . $postId . '"');

        // Направить в чат
        go_die($container, '/chat');
    }
}

// Установить данные
$view->set('errors', $error->getErrors(), 'error');
$view->set('error', $error->show())
    ->set('post', (object) [
        'post_uid' => $postId,
        'message' => $request->has('message') ? $request->message : $post->message
    ]);

// Рендерить edit
$view->render('edit')->put();
