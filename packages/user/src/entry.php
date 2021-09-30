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
    go_die($container);
}

// Установить имя страницы
$view->title = 'Авторизация';

// Подключить зависимости
$request = $container->get('request')->post;
$error = $container->get('error');

// Если присутствует post данные
if ($request->has('submit')) {

    if ($request->em('login')) $error->set('Вы не ввели логин');
    if ($request->em('password')) $error->set('Вы не ввели пароль');

    // Если нет ошибок
    if (! $error->getErrors()) {
        // Обработать логин  и пароль
        $login =  Misc::str($request->login, $container);
        $password = Misc::str($request->password, $container);

        dd($login);

        // Подключить базу данных
        $db = $container->get('db');
        // Выполнить запрос
        $query = $db->query('SELECT password FROM user WHERE login = "' . $login . '" LIMIT 1');

        // Если пользователь найден, получить хэш пароля
        if ($row = $query->fetch_object())
        {
            // Если пароли совпадают
            if (Password::has($password, $row->password)) {
                // Подключить куки
                $cookie = $container->get('cookie');

                // Установить куки
                $cookie->login($login, ['expires' => TIME + YEAR]);
                $cookie->password($row->password, ['expires' => TIME + YEAR]);

                // Завершить работу скрипта и перейти
                go_die($container);
            } else
                $error->set('Неверный логин или пароль');
        } else
            $error->set('Неверный логин или пароль');
    }
}

// Установить данные для шаблона error
$view->set('errors', $error->getErrors(), 'error');

// Установить данные для главного шаблона
$view->set('entry', (object) [
    'error' => $error->show(),
    'login' => $request->login,
    'password' => $request->password
]);

// Рендерить
$view->render('entry');
