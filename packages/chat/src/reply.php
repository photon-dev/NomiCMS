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

// Не авторизован
if (! $user->logger) {
    go_die($container, '/');
}

// Индификатор сообщения
$userLogin = $userLogin ?? false;
$userLogin = Misc::str($userLogin, $container);

// Получить db
$db = $container->get('db');

// // Выполнить запрос
$result = $db->query('SELECT uid FROM user WHERE login = "' . $userLogin . '" LIMIT 1');

// Пост не найден
if (! $result->num_rows) {
    error('Сообщение не найдено');
}

// Получить user_uid, message, в виде обьекта
$us = $result->fetch_object();
$result->free();

// Нет доступа к посту
if ($post->user_uid == $user->getUser()['uid']) {
    go_die($container, '/chat');
}

// Настроить seo
$view->title = 'Ответить - ' . $userLogin;

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

    // Обработать данные
    $user_uid = Misc::abs($user->getUser()['uid']);

    // Cообщение не введно
    if ($request->em('message')) {
        $error->set('Введите сообщение');
    } elseif (strlen($request->message) > 1024) {
        $error->set('Неверная длина сообщения. Допустимо макс 1024 символов');
    }

    // Нет ощибок
    if (! $error->show()) {
        $login = "[reply=user/{$us->uid}]{$userLogin}[/reply]";
        $message = Misc::str($login . $request->message, $container);

        // Выполнить запрос, создать сообщение
        $db->query('INSERT INTO `chat` set user_uid = "' . $user_uid . '", message = "' . $message . '", date_write = "' . TIME . '"');

        // Добавить монету пользователю
        $db->query('UPDATE user SET coins = coins + 1 WHERE uid = "' . $user_uid . '"');

        // Направить в чат
        go_die($container, '/chat');
    }
}

// Установить данные
$view->set('errors', $error->getErrors(), 'error');
$view->set('error', $error->show())
    ->set('post', (object) [
        'user_login' => $userLogin,
        'message' =>  $message ?? ''
    ]);

$view->render('reply')->put();
