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

// Подключиться к базе данной
$db = $container->get('db');

// Имя, описание, ключевые слова
$view->title = 'Новости';
$view->description = 'Список новостей сайта';
$view->keywords = 'Новости, news';

// Получить количество новостей
$count = $db->query('SELECT COUNT(*) FROM news')->fetch_row();

// Подключить постраничную навигацию
$page = $container->get('pagination', [
    'count' => $count[0],
    'limit' => $app->post_page,
    'page' => $pageId ?? ''
]);

// Строки
$rows = [];

// Сделать выборку из базы данных
$result = $db->query('SELECT n.*, COUNT(nc.uid) AS comments
FROM news AS n
LEFT JOIN news_comments AS nc
ON nc.news_uid = n.uid
GROUP BY n.uid
ORDER BY n.uid DESC LIMIT  ' . $page->start . ', ' . $app->post_page);

// Обработать
while ($news = $result->fetch_assoc()) {
    $news['date_write'] = DateTime::times($news['date_write']);
    $news['message'] = Misc::output($news['message']);
    $rows[] = $news;
}

// Установить полученные новости
$view->set('index', $rows, 'row');

// Установить постраничную навигацию
$page->view($view, '/news');

// Рендерить шаблон
$view->render('index');
