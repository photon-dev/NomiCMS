<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Request;

// Использовать
//use System\Http\Request\RequestFactory;
//use System\Http\Request\RequestException;

/**
 * Класс фабрика запросов
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
    public function get($name)
    {
        if ($this->has($name)) {
            return $this->data[$name];
        }
    }
}
