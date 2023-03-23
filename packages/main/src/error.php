<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$errorId = $errorId ?? 404;

$view->title = 'Ошибка, ' . $errorId;

// Список ошибок
switch ($errorId) {
    case 400:
        $error = 'Обнаруженная ошибка в запросе';
        break;
    case 401:
        $error = 'Нет прав для выдачи документа';
        break;
    case 402:
        $error = 'Не реализованный код запроса';
        break;
    case 403:
        $error = 'Доступ запрещен';
        break;
    case 404:
        $error = 'Нет такой страницы';
        break;
    case 500:
        $error = 'Внутренняя ошибка сервера';
        break;
    case 502:
        $error = 'Сервер получил недопустимые ответы другого сервера';
        break;
    default:
        $error = 'Нет такой страницы';
        break;
}

$view->set('error', $error);

$view->render('error.view')->put();
