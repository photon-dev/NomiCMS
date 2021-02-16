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
 * Класс Password
 */
class Password
{
    public static function create(string $pass, array $options = ['cost' => 10])
    {
        return password_hash($pass, PASSWORD_DEFAULT, $options);
    }

    // Получить информацию о заданном хеше
    public static function info(string $hash)
    {
        return password_get_info($hash);
    }

    // Проверить пароль
    public static function has(string $pass, string $hash)
    {
        return password_verify($pass, $hash);
    }
}
