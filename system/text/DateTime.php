<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Text;

// Использовать
use System\Text\Misc;

/**
 * Класс DateTime
 */
class DateTime
{
    // Заменить названия месяцев
    protected static function replaceMonths(string $date)
    {
        $months = [
            'Jan' => 'Января',
            'Feb' => 'Февраля',
            'Mar' => 'Марта',
            'May' => 'Мая',
            'Apr' => 'Апреля',
            'Jun' => 'Июня',
            'Jul' => 'Июля',
            'Aug' => 'Августа',
            'Sep' => 'Сентября',
            'Oct' => 'Октября',
            'Nov' => 'Ноября',
            'Dec' => 'Декабря'
        ];

        return strtr($date, $months);
    }

    // Получить дату
    public static function get(string $format = 'j M Y H:i')
    {
        $data = date($format, TIME);

        return self::replaceMonths($data);
    }

    // Получить время
    public static function times(int $timestamp = 0)
    {
        $ago = TIME - $timestamp;

        // Если прошло >= 24 часов (Одного дня)
        if ($ago >= DAY) {

            // Получить текущий год
            $currentYear = date('Y', TIME);
            // Получить указанный год
            $specifiedYear = date('Y', $timestamp);

            // Если текущий год равен указанный год
            if ($currentYear == $specifiedYear) {
                $dateTime = date('j M в H:i', $timestamp);
            } else {
                $dateTime = date('j M Y в H:i', $timestamp);
            }

            return self::replaceMonths($dateTime);
        }

        // Если прошло >= час
        if ($ago >= HOUR) {
            $hour = (string) floor($ago / HOUR);
            $words = Misc::nums($hour, 'час', 'часа', 'часов');

            // Показать часы
            return "$hour $words назад";
        }

        // Если прошло >= минуты
        if ($ago >= MINUTE && $ago < HOUR) {
            $minute = (string) floor($ago / MINUTE);
            $words = Misc::nums($minute, 'минуту', 'минуты', 'минут');

            // Показать минуты
            return "$minute $words назад";
        }

        // Если выше указанные условия не совпали
        //$sec = (string) $ago;
        //$words = Misc::nums($sec, 'секунда', 'секунды', 'секунд');
        //return "$sec $words назад";

        // Показать
        return 'только что';
    }
}
