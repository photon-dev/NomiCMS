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

        // Если сессия не найдена
        if (! $this->has($name) && ! $overwrite) {
            return $_SESSION[$name] = $value;
        }

        return false;
    }

    // Установить сессию через метод
    public function __call(string $name, array $session)
    {
        // Ценность
        $value = $session[0];

        //dd($session[0]);

        // Перезапись
        $overwrite = $session[1];
        $overwrite =  is_bool($overwrite) ? $overwrite : true;

        $this->set($name, $value, $overwrite);
    }

    // Установить сессию
    // Пример: $session->имя сессии = 'Данные для сохранения';
    public function __set(string $name, string $value)
    {
        $this->set($name, $value);
    }

    // Получить cookie
    public function __get(string $name)
    {
        if ($this->has($name)) {
            return $_SESSION[$name];
        }

        return false;
    }

    // Проверка сессии
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
