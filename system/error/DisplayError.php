<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Error;

/**
 * Класс DisplayError
 */
class DisplayError
{
    // Список ошибок
    protected $errors = [];

    // Показать
    protected $show = false;

    public function __construct(){}

    // Установить ошибку
    public function set(string $text): void
    {
        $this->errors[] = $text;
        $this->show = true;
    }

    // Получить show
    public function show(): bool
    {
        return $this->show;
    }

    // Получить список ошибок
    public function getErrors()
    {
        if ($this->show) {
            return $this->errors;
        }

        return false;
    }
}
