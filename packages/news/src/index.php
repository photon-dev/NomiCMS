<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Новости';
$view->description = 'Список новостей сайта';
$view->keywords = 'Новости, news';

// Подключиться к базе данной
$db = $container->get('db');

$page = $container->get('pagination', [
    'count' => 156,
    'limit' => 7
]);

$page->view($view);

/*
$query = 'SELECT *
FROM news ORDER BY uid DESC LIMIT 10';

$result = $db->query($query);

dd($result->num_rows);
*/

$view->render('index');
