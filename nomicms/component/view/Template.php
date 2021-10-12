<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\View;

// Использовать
use Nomicms\Component\View\TemplateInteface;
use Nomicms\Component\View\TemplateNotFound;

/**
 * Класс Template
 */
class Template
{
    // Для всех
    private $all = [];

    // Для выбранного
    private $some = [];

    // Для главного
    private $main = [];

    // Установить данные
    public function set(string $key, $data, string $flag = ''): TemplateInteface
    {
        // Запомнить данные по ключу
        $data = [$key => $data];

        // Если true, тогда поместить данные в $some
        if (! empty($flag)) {

            // Если для выбранный шаблон уже указан, смешать все данные
            if ($this->has($flag)) {
                $data = array_merge($this->some[$flag], $data);
            }

            // Сохранить по флагу
            $this->some[$flag] = $data;
            return $this;
        }

        // Установить для главного
        $this->main = array_merge($this->main, $data);

        return $this;
    }

    // Установить данные для всех
    public function setAll($data, string $key = ''): TemplateInteface
    {
        if (! empty($key)) {
            $data = [$key => $data];
        }

        $this->all = array_merge($this->all, $data);
        return $this;
    }

    // Получить имя шаблона
    private function getKey(string $key): string
    {
        $pos = strrpos($key, '/');
        return substr($key, 0, $pos);
    }

    // Проверить одиночку
    public function has(string $key): bool
    {
        return isset($this->some[$key]);
    }

    // Получить данные
    public function get(string $template)
    {
        // Данные
        $data = [];

        // Получить первое вхождение
        if (strpos($template, '/')) {
            $template = $this->getKey($template);
        }

        // Получить данные выбранного шаблона
        if ($this->has($template)) {
            $data = array_merge($data, $this->some[$template]);
        } else {
            $data = array_merge($data, $this->main);

            // Стереть данные
            $this->main = [];
        }

        // Слить с данными для всех
        $data = array_merge($data, $this->all);

        // Показать
        return $data;
    }
}
