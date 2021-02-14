<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Cookie;

/**
 * Класс Cookie
 */
class Cookie
{
    // Конструктор
    public function __construc(){}

    // Установить печенье
    protected function setCookie(string $name, string $value, array $options = []): bool
    {
        return setcookie($name, $value, $options);
    }

    // Установить печенье через метод
    public function __call(string $name, $cookie)
    {
        // Ценность
        $value = $cookie[0];
        // Опции
        $options = $cookie[1];

        // Установить
        $this->setCookie($name, $value, $options);
    }

    // Получить печенье
    public function __get(string $name)
    {
        // Если печенье существует
        if ($this->has($name)) {
            // Получить
            return $_COOKIE[$name];
        }
    }

    // Проверка печенья
    public function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    // Проверка на пустоту
    public function empty(string $name): bool
    {
        return empty($name);
    }

}
