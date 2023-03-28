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

// Если авторизован
if (! $user->logger) {
    go_die($container, '/chat');
}

// Настроить seo
$view->title = 'Отправить сообщение';

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
    // Подключить db
    $db = $container->get('db');

    // Обработать данные
    $user_uid = Misc::abs($user->getUser()->uid);

    // Cообщение не введно
    if ($request->em('message')) {
        $error->set('Введите сообщение');
    } elseif (strlen($request->message) > 1024) {
        $error->set('Неверная длина сообщения. Допустимо макс 1024 символов');
    } elseif ($db->query('SELECT date_write FROM chat WHERE user_uid = "' . $user_uid . '" AND date_write+5 > "' . TIME . '" LIMIT 1')->num_rows > 0) {
        $error->set('Запрещено писать чаще 30 сек');
    }

    // Нет ощибок
    if (! $error->show()) {
        $message =  Misc::str($request->message, $container);

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
    ->set('code', mt_rand(101, 999))
    ->set('message', $request->message);

// Рендерить add
$view->render('add')->put();
