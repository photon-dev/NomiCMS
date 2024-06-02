<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

use Nomicms\Component\Text\{
    Misc, Valid, Password
};
use Nomicms\Component\Http\Ipus;

// Если авторизован
if ($user->logger) {
    go_die($container, '/');
}

$view->title = 'Регистрация';

// Получить request, error
$request = $container->get('request')->post;
$error = $container->get('error');

// Если присутствует post submit
if ($request->has('submit')) {
    // Подключить db
    $db = $container->get('db');

    // Проверить логин
    if ($request->em('login')) {
        $error->set('Вы не ввели логин');
    } elseif (strlen($request->login) < 3 || strlen($request->login) > 20) {
        $error->set('Неверная длина логина. Допустимо от 3 до 15 символов');
    } elseif (Valid::login($request->login)) {
        $error->set('В логине присутствуют запрещенные символы');
    // Если логин уже занят
    } elseif ($db->query('SELECT nick FROM user WHERE nick = "' . Misc::str($request->login, $container) . '" LIMIT 1')->num_rows != 0) {
        $error->set("Логин: <b>{$request->login}</b>, уже зарегистрирован");
    }

    // Проверить пароль
    if ($request->em('password')) {
        $error->set('Вы не ввели пароль');
    } elseif (strlen($request->password) < 6 || strlen($request->password) > 32) {
        $error->set('Неверная длина пароля. Допустимо от 6 до 32 символов');
    } elseif (Valid::password($request->password)) {
         $error->set('В пароле присутствуют запрещенные символы');
    } elseif ($request->password != $request->password2) {
        $error->set('Пароли не совпадают');
    }

    // Проверить имя
    if (! $request->em('name') && strlen($request->name) < 2 || strlen($request->name) > 32) {
        $error->set('Неверная длина имени. Допустимо от 2 до 32 символов');
    } elseif (! $request->em('name') && Valid::name($request->name)) {
        $error->set('В имени присутствуют запрещенные символы');
    }

    // Проверить пол
    if ($request->em('gender')) $error->set('Вы не выбрали пол');

    // Проверить проверочный код
    if ($request->em('code')) {
        $error->set('Вы не ввели проверочный код');
    } else if ($request->code != $container->get('session')->captcha) {
        $error->set('Проверочный код введен не верно');
    }

    // Если нет ошибок
    if (! $error->show()) {
        // Обработать данные
        $login =  Misc::str($request->login, $container);
        $password = Misc::str($request->password, $container);
        $name = ($request->name) ? Misc::str($request->name, $container) : '';
        $gender = ($request->gender != 'male') ? 'female' : 'male';

        // Создать хэш пароля
        $password = Password::create($password);
        $hash = Password::cutHash($password, true);

        //Выполнить запрос, создать пользователя
        $db->query('INSERT INTO user (algo, token, nick, name, gender, ip, time_signup, time_entry)
        VALUES (
            "' . $hash['algo'] . '", "' . $hash['token'] . '", "' . $login . '", "' . $name . '", "' . $gender . '", "' . Ipus::to() . '", "' . TIME . '", "' . TIME . '"
        );');
        // Получить следущий индификатор
        $next_id = $db->insert_id;

        // Если превый зарегистрированый получит разработчика
        if ($next_id == 1) {
            $db->query('UPDATE user SET level = "4" WHERE uid = "' . $next_id . '"');
        }

        // Cоздать настройки пользователя
        $db->query('INSERT INTO user_settings (user_id) VALUES ("' . $next_id . '");');
        // Cоздать социальные ссылки
        $db->query('INSERT INTO user_soc (user_id) VALUES ("' . $next_id . '");');

        // Установить cookie
        $container->get('cookie')->password($hash['token'], ['expires' => TIME + YEAR]);

        // Перейти в кабинет
        go_die($container, '/user');
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
$view->render('signup')->put();
