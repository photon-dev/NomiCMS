<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Misc;

// Если уже авторизован
if ($container->get('user')->logger) {
    header('location: /');
    exit;
}

// Установить имя страницы
$view->title = 'Авторизация';

// Подключить request
$request = $container->get('request')->post;

// Данные для шаблона entry
$post = [
    'errors' => false,
    'login' => false,
    'password' => false,
    'code' => false
];

// Если присутствует post данные
if ($request->has('login') && $request->has('password') && $request->has('code')) {

    $post['login'] = $request->login;
    $post['password'] = $request->password;
    $post['code'] = $request->code;

    if (empty($post['login'])) $post['errors'][] = 'Вы не ввели логин';
    if (empty($post['password'])) $post['errors'][] = 'Вы не ввели пароль';
    if (empty($post['code'])) $post['errors'][] = 'Вы не ввели код с картинки';

}

$view->set($post, 'entry');

$view->render('entry');
