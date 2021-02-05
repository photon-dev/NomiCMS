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
    protected static $storage = [];

    // Добавить строку
	public static function set(string $key, string $value = ''): void
	{
        // Сохранить
        self::$storage[$key] = $value;
	}

    // Добавить массив
    public static function setArray(string $key, array $data): void
    {
        self::$storage[$key] = $data;
    }

    // Добавить обьект
    public static function setObject(string $key, object $data): void
    {
        self::$storage[$key] = $data;
    }

    // Получить данные
    public static function get(): array
    {
        return self::$storage;
    }

    // Очистить данные
    public static function сlear(): void
    {
        self::$storage = [];
    }
}
