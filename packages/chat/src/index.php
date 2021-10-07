<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\Core\Secure;
use System\Text\{
    DateTime, Misc
};

$pageId = $pageId ?? false;

// Получить db, request, error
$db = $container->get('db');
$request = $container->get('request')->post;
$error = $container->get('error');

// Выполнить запрос и получить сообщений
$count = $db->query('SELECT COUNT(*) FROM chat')->fetch_row()[0];

// Настроить seo
$view->title = "Мини-чат ({$count})";
$view->desc = 'Мини-чат - это чат для мнгновенного обмена сообщения между пользователями. Для общения требуться регистрация.';
$view->keywords = 'Чат, Общение, chat, message';

// Получить пагинацию
$page = $container->get('pagination', [
    'count' => $count,
    'limit' => 3,//$app->post_page,
    'page' => $pageId
]);

// Сделать выборку из базы данных
$result = $db->query('SELECT c.*, u.login, u.level
FROM chat AS c
LEFT JOIN user AS u
ON u.uid = c.user_uid
GROUP BY c.uid
ORDER BY c.uid DESC LIMIT  ' . $page->start . ', ' . 3);

// Обработать
while ($chat = $result->fetch_object()) {
    $chat->date_write = DateTime::times($chat->date_write);
    $chat->message = Misc::output($chat->message);
    $posts[] = $chat;
}

$rand = mt_rand(101, 999);

// Установить данные для шаблона error
$view->set('errors', $error->getErrors(), 'error');

// Установить данные для главного шаблона
$view->set('error', $error->show())
    ->set('posts', $posts ?? false)
    ->set('code', $rand)
    ->set('logger', $user->logger);

// Установить постраничную навигацию
$page->view($view, '/chat');

// Рендерить шаблоны posts
$view->render('posts');
