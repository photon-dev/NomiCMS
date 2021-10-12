<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Handler;

/**
 * Класс Обработчик ошибок
 */
class ErrorHandler
{
    // Список ошибок
    protected $list = [
        0 = 'Не известная ощибка';
        3 = 'Пакет либо /s не найден';
        4 = 'Исходный файл /s не найден';
        404 = 'Страница не найдена'
    ];

    // Текущая ошибка
    public $errors = [];

    // Найден
    public $found = false;

    // Конструктор
    public function __construct(array $listErrors = []) {
        //$this->list = $listErrors;
    }

    // Вырезать из строки символ и замемить его нужным нам словом
    protected function strr(string $str, string $replace): string
    {
        return str_replce('/s', $replce, $str);
    }

    // Проверить если такая ошибка в системе
    public function has(int $id): bool
    {
        return isset($list[$id]);
    }

    // Установить ошибку
    public function set(int $id = 0, string $words = ''): void
    {
        // Проверить ощибку в списке
        if ($this->has($id)) {
            // Достать ощибку
            $error = $list[$id];

            // Обработать если требуеться
            if (empty($words)) {
                $error = $this->strr($error, $words);
            }

            // Превратить в массив
            $error[] = $error;

            // Слить массив с общим списком всех ошибок
            array_merge($errors, $this->errors);

            // Установить что ошибка найдена
            $this->found = true;
        }
    }

    // Показать ошибки
    public function view(bool $preend = false)
    {
        return [];
    }
}
