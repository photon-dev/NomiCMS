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
    // Для всех
    public $everyone = [];

    // Для выбранного
    protected $some = [];

    // Установить данные для выбранного
    public function set(...$set)
    {
        // Имя шаблона
        $template = $set[0];

        // Слить
        $merge = $set[2] ?? $template;

        // Если данные евляються обьектом или старокой
        if (is_object($set[1]) || is_string($set[1])) {
            $this->some[$template] = [$merge => $set[1]];
            return true;
        }

        if (isset($set[2])) {
            $data = [$merge => $set[1]];
        } else {
            $data = $set[1];
        }

        $this->some[$template] = $data;

        return true;
    }

    // Установить данные для всех
    public function setAll($data): void
    {
        $this->everyone = array_merge($this->everyone, $data);
    }

    // Проверить одиночку
    public function hasSome(string $template): bool
    {
        return isset($this->some[$template]);
    }

    // Получить данные
    public function get(string $template)
    {
        $data = [];

        // Получить данные выбранного шаблона
        if (isset($this->some[$template])) {
            $data = array_merge($data, $this->some[$template]);
            
            // Стереть данные
            unset($this->some[$template]);
        }

        // Слить с данными для всех
        $data = array_merge($data, $this->everyone);

        // Показать
        return $data;
    }
}
