<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

//$view->title = 'Главная страница';
//$view->desc = 'Описание главной страницы';
//$view->keywords = 'Ключевые слова';

// Получить пользователя
$user = $container->get('user');

// Получить базу данных
$db = $container->get('db');

$view->navbar();

/*
$query = 'SELECT COUNT(n.uid) as count_news, COUNT(u.uid) as count_user
FROM news AS n
LEFT JOIN user AS u
GROUP BY n.uid AND u.uid';
*/

// Выполнить запрос, и получить количество
$count = $db->query('SELECT
(SELECT COUNT(*) FROM news) AS news,
(SELECT COUNT(*) FROM news WHERE date_write > "' . (TIME - DAY) . '") AS new_news,
(SELECT COUNT(*) FROM chat) AS chat_message,
(SELECT COUNT(*) FROM chat WHERE date_write > "' . (TIME - DAY) . '") AS new_chat_message,
(SELECT COUNT(*) FROM user) AS users,
(SELECT COUNT(*) FROM user WHERE date_signup > "' . (TIME - DAY) . '") AS new_users
FROM dual')->fetch_assoc();

$post = [
    'count' => $count
];

$view->set('index', $post);

// Рендерим шаблон
$view->render('index');
