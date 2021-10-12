<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Text;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Database\DB;
use Nomicms\Component\Text\Bbcode;
use Nomicms\Component\Text\Emoji;
use Nomicms\Component\Session\Session;

/**
 * Класс Misc
 */
class Misc
{
    // Обработать число
    public static function abs(int $int): int
    {
        // Обработать
        $int = abs(intval($int));

        // Показать
        return $int;
    }

    // Обработать строку перед помещением в базу данных
    public static function str(string $str, ContainerInterface $container): string
    {
        // Обработать строку
        $str = trim($str);
        $str = $container->get('db')->real_escape_string($str);
        $str = htmlspecialchars($str, ENT_QUOTES);

        // Показать
        return $str;
    }

    // Обработать сроку перед показом в html коде
    public static function output(string $text): string
    {
        $text = nl2br($text);
        $text = htmlspecialchars_decode($text, ENT_QUOTES);
        $text = Emoji::parse($text);
        $text = Bbcode::parse($text);

        // Показать
        return $text;
    }

    // Получить рандомную строку
    public static function random(int $amount = 1, int $length = 32): string
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
            switch (mt_rand(1, $amount)) {
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

    /**
     * Получить изменные окончания слов
     * Пример:
     * День, дня, дней
     */
    public static function nums(string $num, string $one, string $two, string $more): string
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

    // Получить рандомное число в байтах
    public static function rand(int $count = 9): string
    {
        // Получить строку
        $bytes = random_bytes($count);

        // Перевести, показать
        return bin2hex($bytes);
    }

}
