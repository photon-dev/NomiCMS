<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Config;

// Использовать
use System\Config\Exception\ConfigNotFound;

/**
 * Класс Config
 */
class Config
{
    protected static $storage = [];

    public static function get(string $key)
    {
        // Проверка по ключу
        if (self::has($key) === false) {
            throw new ConfigNotFound("Ключ: {$key} в System\Config\Config не обнаружен");
        }

        return self::$storage[$key];
    }

    // Добавить в хранилище
    public static function add(string $key, array $data, bool $output = false)
    {
        // Проверка по ключу
        if (self::has($key) === true) {
            throw new ConfigNotFound("Ключ: {$key} в System\Config\Config уже занят");
        }

        self::$storage[$key] = $data;

        // Вывод eсли true
        if ($output === true) {
            return $data;
        }
    }

    public static function pull(string $config, bool $package = false) {

        // Загружаем данные из файла
        $data = self::load($config, $package);

        // Получить ключ
        $key = self::getKey($config, $package);

        // Добавить в хранилище
        self::add($key, $data);

        // Вывод если загружен
        return $data;
    }

    // Загрузка файла
    public static function load(string $path, bool $package)
    {
        // Если PACKAGE тогда загружаем из папки packages/
        if ($package) {
            return loadFile('packages/' .$path);
        }

        return loadFile('config/' .$path);
    }

    // Проверка значения
    protected static function has(string $key): bool
    {
        return (isset(self::$storage[$key]) && array_key_exists($key, self::$storage));
    }

    // Получить ключ
    protected static function getKey(string $config, $package): string
    {
        // Если PACKAGE тогда загружаем из папки packages/
        if ($package) {
            return substr($config, 0, strpos($config, '/'));
        }

        return substr($config, strrpos($config, '/') + 1);
    }

    // Получить все данные
    public static function getStorage()
    {
        return self::$storage;
    }
}
