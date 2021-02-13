<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\View;

// Использовать
use System\Container\ContainerInterface;
use System\View\Template;
use Exception;

/**
 * Класс Template
 */
class Template //extends Template
{
    // Карта
    public $map = [];

    // Для всех
    public $everyone = [];

    // Для некоторых, или одиночки
    public $some = [];

    // Передано
    public $output = [];

    // Установить для одиночки
    public function set(array $data, string $template): bool
    {
        // Сохранить в карту имя шаблона
        array_push($this->map, $template);

        // Если шаблон найден, установить для него дополнительные данные
        if (isset($this->some[$template])) {
            $this->some[$template] = array_merge($this->some[$template], $data);
            return true;
        }

        $this->some[$template] = $data;

        return false;
    }

    // Установить для всех
    public function setAll(array $data): void
    {
        $this->everyone = array_merge($this->everyone, $data);
    }

    public function has(string $name)
    {
        return isset($map[$name]);
    }

    // Получить данные
    public function get(string $template)
    {
        $data = [];

        // Получить данные для шаблона
        if (isset($this->some[$template])) {
            $data = array_merge($data, $this->some[$template]);

            // Стереть данные
            unset($this->some[$template]);
        }

        $data = array_merge($data, $this->everyone);

        return $data;
    }

}
