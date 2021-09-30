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

 // Если авторизован
 if ($user->logger) {
     go_die($container, '/');
 }

// Получить зависимость request
$request = $container->get('request')->post;
$error = $container->get('error');

// Если присутствует post submit
if ($request->has('submit')) {
    // Логин, пароль не введены
    if ($request->em('login')) $error->set('Вы не ввели логин');
    if ($request->em('password')) $error->set('Вы не ввели пароль');

    // Если длина логина не допустима
    if (! $request->em('login')
        && strlen($request->login) < 3
        || strlen($request->login) > 20
    ) $error->set('Неверная длина логина. Допустимо от 3 до 15 символов');

    // Если длина логина не допустима
    if (! $request->em('password')
        && strlen($request->password) < 5
        || strlen($request->password) > 32
    ) $error->set('Неверная длина пароля. Допустимо от 6 до 32 символов');

    // Если логин, пароль не валиден
    if (! $request->em('login') && Valid::login($request->login)) $error->set('В логине присутствуют запрещенные символы');
    if (! $request->em('password') && Valid::password($request->password)) $error->set('В пароле присутствуют запрещенные символы');

    // Если пароли не совпадают
    if (! $request->em('password') && $request->em('password2')) $error->set('Вы не ввели повторение пароля');

    // Если пароли не совпали
    if (! $request->em('password') &&
        ! $request->em('password2') &&
        $request->password != $request->password2
    ) $error->set('Пароли не совпадают');

    if ($request->em('gender')) $error->set('Вы не выбрали пол');

    // Если проверочный код, не введен, не совпал
    if ($request->em('code')) $error->set('Вы не ввели проверочный код');
    if (! $request->em('code')
        && $request->code != $container->get('session')->captcha
    ) $error->set('Проверочный код введен не верно');

    // Если нет ошибок
    if (! $error->show()) {
        // Обработать данные
        $login =  Misc::str($request->login, $container);
        $password = Misc::str($request->password, $container);
        $name = Misc::str($request->name, $container);

        dd($name);

    }
}

// Установить данные для шаблона error, success
$view->set('errors', $error->getErrors(), 'error');

// Установить данные для главного шаблона
$view->set('error', $error->show())
    ->set('login', $request->login)
    ->set('password', $request->password)
    ->set('password2', $request->password2)
    ->set('name', $request->name)
    ->set('gender', $request->gender);

// Рендерить
$view->render('signup');
