<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Session;

/**
 * Класс Session
 */
class Session
{
    // Конструктор
    public function __construc(){}

    // Установить сессию
    protected function set(string $name, $value, bool $overwrite = true): bool
    {
        // Если перезапись указана
        if ($overwrite) {
            $_SESSION[$name] = $value;

            return true;
        }

        // Если сессия не найдена, и перезапись отключена
        if (! $this->has($name) && ! $overwrite) {
            return $_SESSION[$name] = $value;
        }

        return false;
    }

    // Установить сессию
    public function __set(string $name, $value): void
    {
        $this->set($name, $value);
    }

    // Установить сессию через метод
    public function __call(string $name, array $session): bool
    {
        // Ценность, перезаписать
        $value = $session[0];
        $overwrite =  isset($session[1]) ? $session[1] : true;

        // Установить
        return $this->set($name, $value, $overwrite);
    }

    // Получить сессию
    public function __get(string $name)
    {
        if ($this->has($name)) {
            return $_SESSION[$name];
        }

        return false;
    }

    // Проверить сессию
    public function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    // Проверка на пустоту
    public function em(string $name): bool
    {
        return empty($name);
    }

}
