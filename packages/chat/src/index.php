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

// Получить данные в виде обьекта
while ($chat = $result->fetch_object()) {
    $chat->message = Misc::output($chat->message);
    $chat->date_write = DateTime::times($chat->date_write);
    if ($chat->date_edit > 0) {
        $chat->date_edit = DateTime::times($chat->date_edit);
    }
    $chat->level = $user->getLevel($chat->level);
    $chat->avatar = $user->getAvatar($chat->avatar);
    $chat->status = $user->getStatus($chat->status);

    // Слить посты
    $posts[] = $chat;
}
$result->free();

// Установить данные posts шаблона
$view->set('code', mt_rand(101, 999))
    ->set('posts', $posts ?? false);

// Установить постраничную навигацию
$page->view($view, '/chat');

// Рендерить шаблон posts
$view->render('posts')->put();
