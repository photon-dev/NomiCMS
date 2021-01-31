<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\View;

/**
 * Класс Template
 */
class Template
{
    // Хранилище данных
    protected static $data = [];

    // Добавить массив и разбить по ключам
	public static function set($key, string $text = ''): void
	{
        // Если ключ равен массиву разбить его содержимого на элементы
        if (is_array($key)) {

            // Сохранить в данные
            self::$data = array_merge(self::$data, $key);

        } else {

            // Сохранить текст
            self::$data[$key] = $text;
        }
	}

    // Добавить массив по ключу
    public static function setArray(string $key, array $array): void
    {
        self::$data[$key] = $array;
    }

    // Добавить обьект по ключу
    public static function setObject(string $key, object $object): void
    {
        self::$data[$key] = $object;
    }

    // Получить данные
    public function get(): array
    {
        return self::$data;
    }

    // Очистить данные
    public static function сlear(): void
    {
        self::$data = [];
    }
}
