<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Cookie;

// Использовать

/**
 * Класс Cookie
 */
class Cookie
{
    // Конструктор
    public function __construc(){}

    public function setCookie(string $name, string $value, array $options = []): bool
    {
        return setcookie($name, $value, $options);
    }

    // Установить
    public function __call(string $name, $cookie)
    {
        // Ценность
        $value = $cookie[0];

        // авав
        $options = $cookie[0];

        //dd($options);

        $this->setCookie($name, $value, $options);
    }

    public function __get(string $name)
    {
        if ($this->has($name)) {
            return $_COOKIE[$name];
        }
    }

    // Проверка cookie
    protected function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    // Проверка на пустоту
    protected function empty(string $name): bool
    {
        return empty($name);
    }

}
