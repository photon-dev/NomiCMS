<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Session;

/**
 * Класс Session
 */
class Session
{
    // Конструктор
    public function __construc(){}

    // Установить сессию
    protected function set(string $name, $value, bool $overwrite = true)
    {
        // Если перезапись указана
        if ($overwrite) {
            return $_SESSION[$name] = $value;
        }

        // Если сессия не найдена, и перезапись отключена
        if (! $this->has($name) && ! $overwrite) {
            return $_SESSION[$name] = $value;
        }

        return false;
    }

    // Установить сессию через метод
    public function __call(string $name, array $session): void
    {
        // Ценность
        $value = $session[0];
        // Перезапись
        $overwrite =  is_bool($session[1]) ? $session[1] : true;

        // Установить
        $this->set($name, $value, $overwrite);
    }

    // Установить сессию
    // Пример: $session->имя сессии = 'Данные для сохранения';
    public function __set(string $name, string $value): void
    {
        $this->set($name, $value);
    }

    // Получить сессию
    public function __get(string $name)
    {
        if ($this->has($name)) {
            return $_SESSION[$name];
        }

        return false;
    }

    // Проверка сессию
    public function has(string $name): bool
    {
        return isset($_SESSION[$name]);
    }

    // Проверка на пустоту
    public function empty(string $name): bool
    {
        return empty($name);
    }

}
