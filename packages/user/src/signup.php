<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Если уже авторизован
 if ($user->logger) {
     go_die($container, '/');
 }

// Получить зависимости
$sess = $container->get('session');
$request = $container->get('request')->post;
$db = $container->get('db');

// Если шаг регистрации не установлен
if (! $sess->signup_step)
{
    $signup_step = 0;
}

// Установить шаг
$sess->signup_step = 0;
$sess->signup((object) [
    'login' => false,
]);

switch ($sess->signup_step) {
    // Завершение регистрации
    case 3:

        require 'signup/step_3.php';

        break;
    // Ввод другой информации
    case 2:
        // code...

        require 'signup/step_2.php';

        break;

    // Ввод пароля
    case 1:
        // code...

        require 'signup/step_1.php';

        break;

    // Выбор логина
    default:

        require 'signup/step_0.php';

        break;
}
