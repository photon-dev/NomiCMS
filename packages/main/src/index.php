<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Главная страница';
$view->desc = 'Описание главной страницы';
$view->keywords = 'Ключевые слова';

$user = $container->get('user');

/*
$query = 'SELECT user.*, us.shift_time, us.local, us.theme, us.post_page
FROM user
LEFT JOIN user_settings AS us ON us.user_uid = user.uid
WHERE uid = "1"
';
*/

//$result = $db->query($query);
//$user = $result->fetch_object();

$post = [
    'welcome' => 'Гость',
    'logger' => $user->logger
];

$view->set('index', $post);

$view->render('index');
