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

$view->title = 'Новости';
$view->description = 'Список новостей сайта';
$view->keywords = 'Новости, news';

// Подключиться к базе данной
$db = $container->get('db');

dd($app->system);
$count = $db->query('SELECT COUNT(*) FROM news')->fetch_row();
$limit = 7;

// Подключить постраничную навигацию
$page = $container->get('pagination', [
    'count' => $count[0],
    'limit' => $limit,
    'page' => $pageId ?? ''
]);

// Строки
$rows = [];

// Сделать выборку из базы данных
$result = $db->query('SELECT n.*, COUNT(nc.uid) AS comments
FROM news AS n
LEFT JOIN news_comments AS nc
ON n.uid = nc.news_uid
GROUP BY n.uid
ORDER BY n.uid DESC LIMIT  ' . $page->start . ', ' . $limit);

while ($news = $result->fetch_assoc()) {
    $news['date_write'] = DateTime::times($news['date_write']);
    $news['message'] = Misc::output($news['message']);
    $rows[] = $news;
}

// Установить полученные новости
$view->set('index', $rows, 'row');

// Постраничная навигация
$page->view($view, '/news');

// Рендерить новости
$view->render('index');
