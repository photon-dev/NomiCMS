<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Использовать
 use Nomicms\Component\Text\{
     DateTime, Misc
 };

// Получить db
$db = $container->get('db');

// Выполнить запрос и получить сообщений
$count = $db->query('SELECT COUNT(*) FROM chat')->fetch_row()[0];

// Настроить seo
$view->title = "Мини-чат ({$count})";
$view->desc = 'Мини-чат - это чат для мнгновенного обмена сообщения между пользователями. Для общения требуться регистрация.';
$view->keywords = 'Чат, Общение, chat, message';

// Получить пагинацию
$page = $container->get('pagination', [
    'count' => $count,
    'limit' => $app->post_page,
    'page' => $pageId ?? false
]);

// Выполнить запрос
$result = $db->query('SELECT c.*, u.login, u.level, u.avatar, u.status
FROM chat AS c
LEFT JOIN user AS u
ON u.uid = c.user_uid
GROUP BY c.uid
ORDER BY c.uid DESC LIMIT  ' . $page->start . ', ' . $app->post_page);

// Обработать
while ($chat = $result->fetch_object()) {
    $chat->date_write = DateTime::times($chat->date_write);
    $chat->message = Misc::output($chat->message);
    $chat->level = $user->getLevel($chat->level);
    $chat->avatar = $user->getAvatar($chat->avatar);
    $chat->status = $user->getStatus($chat->status);

    // Слить посты
    $posts[] = $chat;
}
$result->free();

// Установить данные posts шаблона
$view->set('posts', $posts ?? false)
    ->set('code', mt_rand(101, 999));

// Установить постраничную навигацию
$page->view($view, '/chat');

// Рендерить шаблон posts
$view->render('posts')->put();
