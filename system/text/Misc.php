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
use System\Container\ContainerInterface;
use System\Database\DB;
//use System\Text\Smiles;
use System\Text\Bbcode;
use System\Session\Session;

/**
 * Класс Misc
 */
class Misc
{
    // Обработать число
    public static function abs(int $int)
    {
        // Обработать
        $int = abs(intval($int));

        // Показать
        return $int;
    }

    // Обработать строку перед помещением в базу данных
    public static function str(string $str, ContainerInterface $container): string
    {
        // Подключиться к базе данной
        $db = $container->get('db');

        // Обработать строку
        $str = trim($str);
        $str = $db->real_escape_string($str);
        $str = htmlspecialchars($str, ENT_QUOTES);

        // Показать
        return $str;
    }

    // Обработать сроку перед показом в html коде
    public static function output(string $text): string
    {
        $text = nl2br($text);
        //$text = htmlspecialchars($text, ENT_QUOTES);
        //$text = self::bbcode($text);
        $text = Bbcode::code($text);
        //$text = smiles($text);

        // Показать
        return $text;
    }

    // Получить рандомную строку
    public static function random(int $preend = 1, int $length = 32)
    {
        // Пустая строка
        $output = '';
        // Цифры
        $numbers = '0123456789';
        // Маленткие и большые буквы
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $bigLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Обработк,а создание
        for ($i = 0; $i < $length; $i++) {
            switch (mt_rand(1, $preend)) {
                // Содание рандомной цифры
                case 1:
                    $output .= $numbers[mt_rand(0, strlen($numbers) - 1)];

                    break;
                // Создание рандомной буквы
                case 2:
                    $output .= $letters[mt_rand(0, strlen($letters) - 1)];

                    break;
                // Создание рандомной большой буквы
                case 3:
                    $output .= $bigLetters[mt_rand(0, strlen($bigLetters) - 1)];

                    break;
            }
        }

        // Показать
        return $output;
    }

    // Получить изменные окончания слов
    // Пример
    // День, дня, дней
    public static function nums(string $num, string $one, string $two, string $more)
    {
        $l2 = substr($num, strlen($num) - 2, 2);

        if ($l2 >= 5 && $l2 <= 20) {
            return $more;
        }

        $sub = substr($num, strlen($num) - 1, 1);
        switch ($sub) {
            case 1:
                return $one;
                break;
            case 2:
                return $two;
                break;
            case 3:
                return $two;
                break;
            case 4:
                return $two;
                break;
            default:
                return $more;
                break;
        }
    }

    // sdds
    public static function code(Session $session, int $count = 16)
    {
        $code = self::random_b($count);
        $session->code = $code;

        return $code;
    }

    // Получить рандомное число в байтах
    public static function random_b(int $count = 9): string
    {
        // Получить строку
        $bytes = random_bytes($count);

        // Перевести, показать
        return bin2hex($bytes);
    }

}
