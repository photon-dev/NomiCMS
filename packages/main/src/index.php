<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Password;
use System\Http\Ipus;
use System\Text\DateTime;

$view->title = 'Главная страница';
$view->desc = 'Описание главной страницы';
$view->keywords = 'Ключевые слова';

//$user = $container->get('user');

$db = $container->get('db');
$ip = Ipus::getIp();
$pass = Password::create('pass');

$query = 'SELECT user.*, us.shift_time, us.local, us.theme, us.post_page
FROM user
LEFT JOIN user_settings AS us ON us.user_uid = user.uid
WHERE uid = "1"
';

$result = $db->query($query);
$user = $result->fetch_object();
//$last_id = $db->insert_id;

echo DateTime::times($user->date_signup);
echo '<br />' . TIME;

$post = [
    'welcome' => 'Гость'
];

$view->set($post, 'index');

$view->render('index');
