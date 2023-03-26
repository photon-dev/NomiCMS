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
    // Создать хэш
    public static function create(string $pass, array $options = ['cost' => 10]): string
    {
        return password_hash($pass, PASSWORD_BCRYPT, $options);
    }

    // Вырезать из хэша алгоритм шифрования
    public static function cutHash(string $hash): array
    {
        $algo = mb_substr($hash, 0, 7);
        $token = mb_substr($hash, 7);

        return [
            'algo' => $algo,
            'token' => $token
        ];
    }

    // Получить информацию о хеше
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
