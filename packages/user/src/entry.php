<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Misc;
use System\Text\Password;

// Если уже авторизован
if ($user->logger) {
    go_die($container, '/');
}

// Установить имя страницы
$view->title = 'Авторизация';

// Подключить request
$request = $container->get('request')->post;

// Данные для шаблона entry
$post = (object) [
    'error' => false,
    'login' => false,
    'password' => false
];

// Данные для шаблона entry
$error = false;

// Если присутствует post данные
if ($request->has('login') && $request->has('password')) {

    $post->login = $request->login;
    $post->password = $request->password;

    if (! $post->login) $error[] = 'Вы не ввели логин';
    if (! $post->password) $error[] = 'Вы не ввели пароль';

    // Если нет ошибок
    if (! $error) {
        // Подключить сессии, и получить код
        $code = $container->get('session')->captcha;

        // Подключить базу данных
        $db = $container->get('db');

        // Обработать логин  и пароль
        $post->login =  Misc::str($post->login, $container);
        $post->password = Misc::str($post->password, $container);

        // Выполнить запрос
        $query = $db->query('SELECT password FROM user WHERE login = "' . $post->login . '" LIMIT 1');

        // Если пользователь найден
        if ($row = $query->fetch_object())
        {
            // Если пароли совпадают
            if (Password::has($post->password, $row->password)) {
                // Подключить куки
                $cookie = $container->get('cookie');

                // Установить куки
                $cookie->login($post->login , ['expires' => TIME + YEAR]);
                $cookie->password($row->password, ['expires' => TIME + YEAR]);

                go_die($container, '/');
            } else
                $error[] = 'Неверный логин или пароль';
        } else
            $error[] = 'Неверный логин или пароль';
    }
    $post->error = $error ? true : false;
}

// Добавить данные
$view->set('errors', $error, 'error');
$view->set('entry', $post);

// Рендерить
$view->render('entry');
