<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Text;

/**
 * Класс Password
 */
class Password
{
    // Создать хэш паролей
    public static function create(string $pass, array $options = ['cost' => 10]): string
    {
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }

    // Получить информацию о заданном хеше
    public static function info(string $hash): array
    {
        return password_get_info($hash);
    }

    //  Получить доступные идентификаторы алгоритма
    public static function algos(): array
    {
        return password_algos();
    }

    // Проверить пароль
    public static function has(string $pass, string $hash): bool
    {
        return password_verify($pass, $hash);
    }
}
