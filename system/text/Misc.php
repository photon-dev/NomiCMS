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
use System\Text\Smiles;
use System\Text\Bbcode;

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
        // Получить зависимость
        $db = $container->get('database.db');

        // Обработать строку
        $text = trim($text);
        $text = $db->real_escape_string($text);
        $text = htmlspecialchars($text, ENT_QUOTES);

        // Показать
        return $str;
    }

    // Обработать сроку перед показом в html коде
    public static function output(string $text): string
    {
        $text = nl2br($text);
        //$text = bbcode($text);
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

    // Получить рандомное число в байтах, и перевести в int
    public static function random_b(int $count = 9): string
    {
        // Получить строку
        $bytes = random_bytes($count);

        // Перевести, показать
        return bin2hex($bytes);
    }

}
