<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Router;

/**
 * Класс RouterParse
 */
class RouteParse
{
    // Обработка строки браузера
    protected function parseUrl(string $url): string
    {
        $data = [
            '{num}' => '(\d+)',      // Цифры
            '{any}' => '([^/]+)',    // Все символы без знака '/'
            '{all}' => '(.*)',       //Все символы
            '{str}' => '(\w+)',      //Буквенно-цифровые символы
            '{slug}' => '([\w\-_]+)' //Символы формата URL для SEO. (Буквенно-цифровые символы, _ и -)
        ];

        $keys = array_keys($data);
        $values = array_values($data);

        return str_replace($keys, $values, $url);
    }

    // Получить url-адрес из строки браузера
    protected function getCurrentUri(string $uri = ''): string
    {
        // Если url не указан получаем его
        if (empty($uri)) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        // Удалить все что находиться после ?
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }
}
