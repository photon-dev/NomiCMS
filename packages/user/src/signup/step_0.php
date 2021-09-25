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
$success = false;

// Если присутствуют post данные
if ($request->has('login')) {

    if ($request->em('login')) $error[] = 'Вы не ввели логин';

    if (! $request->em('login') && $db->query('SELECT password FROM user WHERE login = "' . Misc::str($request->login, $container) . '"')
        ->num_rows != 0)
            $error[] = "Логин <b>{$request->login}</b> занят";

    // Если нет ощибок
    if (! $error) {
        $success[] = "Логин <b>{$request->login}</b> доступен";
    }
}

// Добавить данные
$view->set('errors', $error, 'error')
    ->set('success', $success, 'success');

$view->set('login', $request->login)
    ->set('error', $error)
    ->set('success', $success);

// Рендерить
$view->render('signup/step_0');
