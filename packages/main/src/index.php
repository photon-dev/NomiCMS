<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use Nomicms\Component\Http\Session\Sess;

// Подключиться к базе
$db = $container->get('db');

// Настроить навигацию
$view->nav = false;

// Выполнить запрос, и получить количество строк
$count = $db->query('SELECT
(SELECT COUNT(*) FROM news) AS news,
(SELECT COUNT(*) FROM news WHERE date_write > "' . (TIME - DAY) . '") AS new_news,
(SELECT COUNT(*) FROM chat) AS chat_message,
(SELECT COUNT(*) FROM chat WHERE date_write > "' . (TIME - DAY) . '") AS new_chat_message,
(SELECT COUNT(*) FROM user) AS users,
(SELECT COUNT(*) FROM user WHERE date_signup > "' . (TIME - DAY) . '") AS new_users
FROM dual')->fetch_assoc();

// Установить данные для шаблона index
$view->set('count', $count);

// Рендерить шаблон, вывод
$view->render('index')->put();

//d();
