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
 * Класс Translite
 */
class Translite
{
    // Маленькие буквы
    protected static $min = [
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd',
        'е' => 'e', 'ё' => 'e', 'ж' => 'zh', 'з' => 'z', 'и' => 'i',
        'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
        'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '',
        'э' => 'e', 'ю' => 'yu','я' => 'ya',
    ];

    // Больщие буквы
    protected static $max = [
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D',
        'Е' => 'E', 'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z', 'И' => 'I',
        'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C', 'Ч' => 'Ch',
        'Ш' => 'Sh', 'Щ' => 'Sch', 'Ь' => '', 'Ы' => 'Y', 'Ъ' => '',
        'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya'
    ];

    // Получить строку на английской
    public static function text(string $str = ''): string
    {
        // Собрать все буквы в один массив
        $letters = array_merge(self::$min, self::$max);

        // Заменить и показать
        return strtr($str, $letters);
    }

    // Получить строку на английской для url
    public static function url(string $url): string
    {
        // Перевести текст в нижний регистр
        $url = mb_strtolower($url);

        // Заменить
        $url = strtr($url, self::$min);

        // Вырезать проблы и другие символы
        $url = mb_ereg_replace('[^-0-9a-z]', '-', $url);
        $url = mb_ereg_replace('[-]+', '-', $url);
        $url = trim($url, '-');

        // Показать
        return $url;
    }
}
