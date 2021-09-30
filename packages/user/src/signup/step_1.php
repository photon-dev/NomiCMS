<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 use System\Text\{
     Misc, Valid, Password
 };

// Заголовок
$view->title = 'Регистрация - Ввод пароля';

// Получить зависимость ошибок
$error = $container->get('error');

// Если запрос post submit найден
if ($request->has('submit')) {
    // Если пароль не введен
    if ($request->em('login')) $error->set('Вы не ввели пароль');
    // Если нет ошибок
    if (! $error->getErrors()) {

    }
}

$success = $success ?? false;
$password = $password ?? $request->password;
$password2 = $password2 ?? $request->password;

// Установить данные для шаблона error, success
$view->set('errors', $error->getErrors(), 'error');

// Установить данные для главного шаблона
$view->set('password', $password)
    ->set('password2', $password2)
    ->set('error', $error->show());

// Рендерить
$view->render('signup/step_1');
