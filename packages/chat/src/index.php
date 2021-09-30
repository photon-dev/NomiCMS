<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Использовать
 use System\Text\DateTime;
 use System\Text\Misc;

// Получить зависимости
$db = $container->get('db');

$msgCount = $db->query('SELECT COUNT(*) FROM chat')->fetch_row()[0];

// Заголовок страницы
$view->title = "Мини-чат ({$msgCount})";
$view->desc = 'Мини-чат - это чат для мнгновенного обмена сообщения между пользователями. Для общения требуться регистрация.';
$view->keywords = 'Чат, Общение, chat, message';

// Посты
$chat = (object) [
    'code' => mt_rand(101, 999),
    'posts' => false
];

if (! $msgCount) {
    dd('Сообщения не найдены');
}

// Получить пагинацию
$page = $container->get('pagination', [
    'count' => $msgCount,
    'limit' => $app->post_page,
    'page' => $pageId ?? ''
]);

// Сделать выборку из базы данных
$result = $db->query('SELECT c.*, u.login, u.level
FROM chat AS c
LEFT JOIN user AS u
ON u.uid = c.user_uid
GROUP BY c.uid
ORDER BY c.uid DESC LIMIT  ' . $page->start . ', ' . $app->post_page);

// Обработать
while ($post = $result->fetch_object()) {
    $post->date_write = DateTime::times($post->date_write);
    $post->message = Misc::output($post->message);
    $chat->posts[] = $post;
}

// Установить данные
$view->set('chat', $chat);

// Рендерить шаблоны posts
$view->render('posts');
