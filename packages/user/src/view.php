<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use Nomicms\Component\Text\Misc;

  // Если не авторизован
if (! $user->logger) {
    go_die($container, '/');
}

$userId = $userId ?? false;
$userId = Misc::abs($userId, $container);

$db = $container->get('db');

// Выполнить запрос в базу данных
$result = $db->query('SELECT u.*, uset.*, usoc.*
FROM user AS u
LEFT JOIN user_settings AS uset ON uset.user_uid = u.uid
LEFT JOIN user_soc AS usoc  ON uset.user_uid = u.uid
WHERE uid = "' . $userId . '" LIMIT 1');

if (! $result->num_rows) {
    error('Пользователь не найден');
}

$profile = $result->fetch_object();
$result->free();

// Имя, описание, ключевые слова
$view->title = $profile->login;
$view->desc= 'Профиль ' . $profile->login;
$view->keywords = '';


$profile->avatar = $user->getAvatar($profile->avatar);

// Добавить данные
$view->set('profile', $profile);

// Рендерить
$view->render('user.view')->put();
