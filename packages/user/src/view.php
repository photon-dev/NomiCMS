<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Misc;

  // Если не авторизован
if (! $user->logger) {
    go_die($container, '/');
}

$userId = $userId ?? false;
$userId = Misc::abs($userId, $container);

$db = $container->get('db');

// Текст запроса в базу данных
$query = 'SELECT u.*, uset.*, usoc.*
FROM user AS u
LEFT JOIN user_settings AS uset ON uset.user_uid = u.uid
LEFT JOIN user_soc AS usoc  ON uset.user_uid = u.uid
WHERE uid = "' . $userId . '" LIMIT 1';

// Выполнить запрос в базу данных
$profile = $db->query($query);

if (! $profile->num_rows) {
    error('Пользователь не найден');
}

$profile = $profile->fetch_object();

// Имя, описание, ключевые слова
$view->title = $profile->login;
$view->desc= 'Профиль ' . $profile->login;
$view->keywords = '';


$text = "Привет. Твой логин {$profile->login}";


// Добавить данные
$view->set('text', $text);

// Рендерить
$view->render('user.view');
