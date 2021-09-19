<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Если уже авторизован
if (! $user->logger) {
    go_die($container, '/');
}

// Имя, описание, ключевые слова
$view->title = 'Кабинет';
$view->desc= 'Кабинет пользователя c ником - ' . $user->getUser()['login'];
$view->keywords = 'Пользователь, кабинет, user';

// Подключиться к базе
$db = $container->get('db');
$us = $user->getUser();

//dd($us);

// Получить количество оповещений, и друзей
$count = $db->query('SELECT
(SELECT COUNT(*) FROM user_alerts WHERE to_whom = "' . $us['uid'] . '") AS alerts,
(SELECT COUNT(*) FROM user_alerts WHERE to_whom = "' . $us['uid'] . '" AND `read` = "no") AS new_alerts,
(SELECT COUNT(*) FROM user_friends WHERE to_whom = "' . $us['uid'] . '" AND `status` = "yes") AS friends,
(SELECT COUNT(*) FROM user_friends WHERE to_whom = "' . $us['uid'] . '" AND `status` = "no") AS new_friends
FROM dual')->fetch_assoc();;

// Установить данные для шаблона index
$view->set('panel', [
    'user' => [
        'uid' => $us['uid'],
        'login' => $us['login'],
        'coins' => $us['coins']
    ],
    'count' => $count
]);

// Рендерить
$view->render('panel');
