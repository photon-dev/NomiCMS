<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Получить зависимости
 $user = $container->get('user');
 $db = $container->get('db');

//$view->title = 'Заголовок страницы';
//$view->desc = 'Описание страницы';
//$view->keywords = 'Ключевые слова';

// Имя, описание, ключевые слова для главной можно не указывать
$view->nav = [
    [
        'url' => '/forum',
        'name' => 'Форум'
    ],
    [
        'url' => '/forum/1',
        'name' => 'NomiCMS'
    ],
    [
        'url' => false,
        'name' => 'Обсуждение v3.4'
    ]
];
//$view->navbar();

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

$view->set('index', [
    'count' => $count
]);

// Рендерим шаблон
$view->render('index');
