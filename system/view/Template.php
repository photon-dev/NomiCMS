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
//use System\View\TemplateInteface;

/**
 * Класс Template
 */
class Template //implements TemplateInteface
{
    // Для всех
    public $everyone = [];

    // Для выбранного
    protected $some = [];

    private $not = false;

    // Установить данные
    public function set(...$set): bool
    {
        // Имя, данные, ключ
        $template = $set[0];
        $data = $set[1];
        $key = $set[2] ?? $template;

        // Если данные евляються обьектом или строкой
        if (is_object($data) || is_string($data)) {
            $data = [$key => $data];
            $this->not = true;
        }

        // Если указаный шаблон найден
        if ($this->hasSome($template)) {
            $data = array_merge($this->some[$template], $data);
        }

        if (isset($set[2]) && ! $this->hasSome($template) && ! $this->not) {
            $data = [$key => $data];
        }

        $this->some[$template] = $data;

        return true;
    }

    // Установить данные для всех
    public function setAll($data): void
    {
        $this->everyone = array_merge($this->everyone, $data);
    }

    // Получить имя шаблона
    private static function getKey(string $str): string
    {
        $pos = strrpos($str, '/');

        return substr($str, $pos + 1);
    }

    // Проверить одиночку
    public function hasSome(string $template): bool
    {
        return isset($this->some[$template]);
    }

    // Получить данные
    public function get(string $template)
    {
        // Получить ключ
        $template = (strpos($template, '/')) ? $this->getKey($template) : $template;

        $data = [];

        // Получить данные выбранного шаблона
        if ($this->hasSome($template)) {
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
