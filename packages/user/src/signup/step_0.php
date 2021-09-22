<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\Misc;

// Если логин выбран перейти на следущий шаг
if ($request->has('next_step') && $sess->signup->login) {
    //go_die($container, '/');
    //$sess->signup_step++;
    dd($request->has('next_step'));
}

// Заголовок
$view->title = 'Регистрация - Выбор логина';

// Данные для шаблона entry
$error = false;
$login = false;
$success = false;

// Если присутствуют post данные
if ($request->has('login')) {
    $login = Misc::str($request->login, $container);

    if (! $login) $error[] = 'Вы не ввели логин';

    if ($db->query('SELECT password FROM user WHERE login = "' . $login . '"')->num_rows >= 1) $error[] = 'Логин занят';

    // Если нет ощибок
    if (! $error) {
        $success[] = "Логин <b>{$request->login}</b> доступен";
        dd('ok');
    }
}

// Добавить данные
$view->set('error', $error, 'errors')
    ->set('success', $success, 'success');

$view->set('signup', [
    'login' => $login,
    'error' => $error
]);

// Рендерить
$view->render('signup/step_0');
