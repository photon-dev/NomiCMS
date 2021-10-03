<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Text;

/**
 * Класс фалидации данных
 */
class Valid
{
    // Проверить имя
    public static function name(string $name)
    {
        // Если не содержит допустимые символы
        if (! preg_match("/^[a-zа-яё\-\_\ ]+$/ui", $name)) {
            return true;
        }

        return ;
    }

    // Проверить пароль
    public static function password(string $pass)
    {
        // Если содержит не допустимые символы
        if (! preg_match("/^[a-zа-яё0-9\-\_\*\.\@\#\$\!\?]+$/ui", $pass)) {
            return true;
        }

        return ;
    }

    // Проверить логин
    public static function login(string $login)
    {
        // Если содержит не допустимые символы
        if (! preg_match("/^[a-zа-яё][a-zа-яё0-9\-\_\ ]+$/ui", $login)) {
            return true;
        }

        // Если содержит и русские и англиское буквы
        if (preg_match("/[a-z]+/ui", $login) && preg_match("/[а-яё]+/ui", $login)) {
            return true;
        }

        // Если в начале или в конце пробел
        if (preg_match("/(^\ )|(\ $)/ui", $login)) {
            return true;
        }


        return ;
    }

    // Проверить email
    public static function email(string $email)
    {
        if (! preg_match('/^[a-z0-9\-\._]+\@([a-z0-9-_]+\.)+([a-z0-9]{2,4})\.?$/ui', $email)) {
            return true;
        }

        return ;
    }
}
