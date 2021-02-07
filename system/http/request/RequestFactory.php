<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Request;

/**
 * Класс RequestFactory
 */
class RequestFactory
{
    // Данные
    protected $data = [];

    // Конструктор
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    // Проверить
    public function has(string $name)
    {
        return isset($this->data[$name]);
    }

    // Получить
    public function __get($name)
    {
        if ($this->has($name)) {
            return $this->data[$name];
        }

        return false;
    }

    // Получить все данные
    public function getData()
    {
        return $this->data;
    }
}
