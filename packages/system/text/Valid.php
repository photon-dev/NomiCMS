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

        return false;
    }
}
