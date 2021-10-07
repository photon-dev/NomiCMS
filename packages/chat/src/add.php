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

// Если авторизован
if (! $user->logger) {
    go_die($container);
}

$view->title = 'Мини-чат - Отправить сообщение';

// Получить request, error
$request = $container->get('request')->post;
$error = $container->get('error');

if ($request->has('submit')) {

    // Cообщение не введно
    if ($request->em('message')) {
        $error->set('Введите сообщение');
    } elseif (strlen($request->message) > 256) {
        $error->set('Неверная длина сообщения. Допустимо макс 256 символов');
    }

    if (! $error->show()) {
        // Подключить db
        $db = $container->get('db');

        // Обработать данные
        $user_uid = Misc::abs($user->getUser()['uid']);
        $message =  Misc::str($request->message, $container);

        // Выполнить запрос, создать сообщение
        $db->query('INSERT INTO chat set user_uid = "' . $user_uid . '", message = "' . $message . '", date_write = "' . TIME . '"');

        // Направить в чат
        go_die($container, '/chat');
    }
}

// Cообщение пустое, ошибка в сообщении
if ($error->show()) {

    // Установить данные
    $view->set('errors', $error->getErrors(), 'error');
    $view->set('error', $error->show())
        ->set('code', mt_rand(101, 999));

    // Рендерить add
    $view->render('add');
}
