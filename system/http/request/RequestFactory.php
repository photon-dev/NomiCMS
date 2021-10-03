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

    // Получить
    public function __get(string $name)
    {
        if ($this->has($name)) {
            return $this->data[$name];
        }

        return '';
    }

    // Проверить
    public function has(string $name): bool
    {
        return isset($this->data[$name]);
    }

    // Проверка на пустоту
    public function em(string $name): bool
    {
        return empty($this->data[$name]);
    }

    // Получить все данные
    public function getData(): array
    {
        return $this->data;
    }
}
