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
    // Получить коректный icq
    public static function icq(int $icq)
    {
        // Проверить и получить
        if (preg_match('#[0-9]{5,9}#', $icq, $res)) {
            return $res[0];
        }

        return ;
    }

    // Проверить пароль
    public static function pass(string $pass): bool
    {
        if (! preg_match("#^[a-zа-яё0-9\-\_\ ]{6,32}$#ui", $pass)) {
            return ;
        }

        return true;
    }

    // Проверить логин
    public static function nick(string $nick): bool
    {
        if (! preg_match("#^[a-zа-яё][a-zа-яё0-9\-\_\ ]{2,20}$#ui", $nick)) {
            return ;
        }

        //
        if (preg_match("#[a-z]+#ui", $nick) && preg_match("#[а-яё]+#ui", $nick)) {
            return ;
        }

        // Если в нике присутствуют запрещенные символы
        if (preg_match("#(^\ )|(\ $)#ui", $nick)) {
            return ;
        }


        return true;
    }
}
