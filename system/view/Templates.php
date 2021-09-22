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
use System\View\TemplateInteface;
use Exception;

/**
 * Класс Template
 */
class Templates implements TemplateInteface
{
    // Для всех, шаблонов
    private $everyone = [];

    // Для выбранного шаблона
    private $some = [];

    // Установить для выбранного шаблона
    public function set(string $key, $data): TemplateInteface
    {
        // Имя, данные, ключ
        $template = $set[0];
        $data = $set[1];

        // Работа с ключами
        $key = $set[2] ?? $template;
        $key = $this->getKeyParse($key);

        // Если данные евляються обьектом или строкой
        if (is_object($data) || is_string($data)) {
            $data = [$key => $data];
            $this->not = true;
        }

        // Если указаный шаблон найден
        if ($this->has($template)) {
            $data = array_merge($this->some[$template], $data);
        }

        if (isset($set[2]) && ! $this->has($template) && ! $this->not) {
            $data = [$key => $data];
        }

        $this->some[$template] = $data;

        return $this;
    }

    // Установить для всех шаблонов
    public function setAll($data, string $key = ''): TemplateInteface
    {
        if (! is_array($data) && ! empty($key)) {
            $data = [$key => $data];
        }

        $this->everyone = array_merge($this->everyone, $data);

        return $this;
    }

    // Проверить одиночку
    public function has(string $key): bool
    {
        return isset($this->some[$key]);
    }

    // Получить имя шаблона
    private function getKey(string $str): string
    {
        $pos = strrpos($str, '/');

        return substr($str, $pos + 1);
    }

    // Получить ключ шаблона
    protected function getKeyParse(string $template): string
    {
        if (strpos($template, '/')) {
            return $this->getKey($template);
        }

        return $template;
    }

    public function render(bool $priority = false)
    {
        $data = [];

        // Получить данные выбранного шаблона
        //if ($this->has($this->block)) {
        $data = array_merge($data, $this->some);

            // Стереть данные
            //unset($this->some[$this->block]);
        //}

        // Слить с данными для всех
        //$data = array_merge($data, $this->everyone);

        dd($data);

        // Показать
        return $data;
    }
}
