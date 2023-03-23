<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use Nomicms\Component\Text\{
    Misc, Password
};

// Если авторизован
if ($user->logger) {
    go_die($container);
}

// Установить имя страницы
$view->title = 'Авторизация';

// Подключить request, error
$request = $container->get('request')->post;
$error = $container->get('error');

// Post submit
if ($request->has('submit')) {

    if ($request->em('login')) $error->set('Вы не ввели логин');
    if ($request->em('password')) $error->set('Вы не ввели пароль');

    // Если нет ошибок
    if (! $error->show()) {
        // Обработать данные
        $login =  Misc::str($request->login, $container);
        $password = Misc::str($request->password, $container);

        // Выполнить запрос
        $query = $container->get('db')->query('SELECT algo, token FROM user WHERE login = "' . $login . '" LIMIT 1');

        // Если пользователь найден
        if ($row = $query->fetch_assoc()) {

            // Если пароли совпадают
            if (Password::has($password, $row['algo'].$row['token'])) {
                // Подключить сессии
                $session = $container->get('session');

                // Установить сессии
                //$session->login = $login;
                $session->token = $row['token'];

                // Если надо запомнить авторизацию
                if ($request->remember_me && $request->remember_me == 'yes') {
                    // Получить cookie
                    $cookie = $container->get('cookie');

                    // Установить cookie
                    $container->get('cookie')
                        ->token($row['token'], ['expires' => TIME + YEAR]);
                }

                // Перейти в кабинет
                go_die($container, '/user');
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
$view->render('entry')->put();
