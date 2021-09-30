<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use System\Text\{
    Misc, Valid
};

// Заголовок
$view->title = 'Регистрация - Выбор логина';

// Получить зависимость ошибок
$error = $container->get('error');

// Если запрос post submit найден
if ($request->has('submit')) {
    // Если логин не введен
    if ($request->em('login')) $error->set('Вы не ввели логин');
    // Если длина логина не допустима
    if (! $request->em('login') && strlen($request->login) < 3 || strlen($request->login) > 20) $error->set('Неверная длина логина. Допустимо от 3 до 15 символов');
    // Если логин не валиден
    if (! $request->em('login') && Valid::login($request->login)) $error->set('В логине присутствуют запрещенные символы');

    // Если нет ошибок
    if (! $error->getErrors()) {
        // Обработать логин
        $login = Misc::str($request->login, $container);

        // Запрос
        $query = 'SELECT login
            FROM user
            WHERE login = "' . $login . '"
            LIMIT 1
        ';
        // Подключить базу данных, и выполнить запрос
        $query = $container->get('db')->query($query)->num_rows;

        // Если логин не найден
        if ($query == 0) {
            // Установить сессию, и совместить данные
            $sess->signup(array_merge($sess->signup, ['login' => $login]));

            $success = "Логин <b>{$request->login}</b> доступен";
        } else
            $error->set("Логин <b>{$request->login}</b> занят");
    }
}

$success = $success ?? false;

if (isset($sess->signup['login'])) {
    $login = $login ?? $sess->signup['login'];
} else {
    $login = $login ?? $request->login;
}

// Установить данные для шаблона error, success
$view->set('errors', $error->getErrors(), 'error');
$view->set('text', $success, 'success');

// Установить данные для главного шаблона
$view->set('login', $login)
    ->set('error', $error->show())
    ->set('success', $success);

// Рендерить
$view->render('signup/step_0');
