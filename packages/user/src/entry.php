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
if ($container->get('user')->logger) {
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
    'password' => false,
    'code' => false
];

// Данные для шаблона entry
$error = false;

// Если присутствует post данные
if ($request->has('login') && $request->has('password') && $request->has('code')) {

    $post->login = $request->login;
    $post->password = $request->password;
    $post->code = $request->code;

    if (! $post->login) $error[] = 'Вы не ввели логин';
    if (! $post->password) $error[] = 'Вы не ввели пароль';
    if (! $post->code) $error[] = 'Вы не ввели код с картинки';

    // Если нет ошибок
    if (! $error) {
        // Подключить сессии, и получить код
        $code = $container->get('session')->captcha;

        // Если проверочный код совпал с введенным
        if ($post->code == $code) {

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
        } else
            $error[] = 'Код с картнки введен не верно';
    }
    $post->error = $error ? true : false;
}

// Добавить данные
$view->set('errors', $error, 'errors');
$view->set('entry', $post);

// Рендерить
$view->render('entry');
