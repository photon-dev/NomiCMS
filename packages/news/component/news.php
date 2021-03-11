<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Получить базу данных
$db = $container->get('db');


// Сделать выборку из базы данных
$result = $db->query('SELECT n.*, COUNT(nc.uid) AS comments
FROM news AS n
LEFT JOIN news_comments AS nc
ON nc.news_uid = n.uid
GROUP BY n.uid
ORDER BY n.uid DESC LIMIT  ' . $page->start . ', ' . $app->post_page);

/*
$query = 'SELECT *
FROM news
ORDER BY date_write DESC LIMIT 1';
*/
