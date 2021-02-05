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
class Config2
{
    protected static $storage = [];

    // Получить
    public static function get(string $key)
    {
        // Проверка по ключу
        if (self::has($key) === false) {
            throw new ConfigNotFound("Ключ: {$key} в System\Config\Config не обнаружен");
        }

        return self::$storage[$key];
    }

    // Добавить в хранилище
    public static function add(string $key, array $data, bool $output = true)
    {
        // Проверка по ключу
        if (self::has($key) === true) {
            throw new ConfigNotFound("Ключ: {$key} в System\Config\Config уже занят");
        }
        // Сохранить данные
        self::$storage[$key] = $data;

        // Вывод eсли true
        if ($output === true) {
            return $data;
        }
    }

    // Загрузить и добавить в хранилище
    public static function pull(string $config, int $preend = 0) {

        // Загрузить файл
        $data = self::load($config, $preend);

        // Получить ключ, добавить в хранилище
        $key = self::getKey($config, $preend);
        self::add($key, $data);

        return $data;
    }

    // Загрузить файл
    public static function load(string $file, int $preend = 0)
    {
        // Если равен 1, тогда путь root/packages/
        if ($preend == 1) {

            $path = PACKS;

        // Если равен 2, тогда путь root/website/themes/
        } elseif ($preend == 2) {

            $path = THEMES;

        // В противном случае root/config/
        } else {
            $path = CONFIG;
        }

        return loadFile($file, $path);
    }

    // Проверка значения
    protected static function has(string $key): bool
    {
        return (isset(self::$storage[$key]) && array_key_exists($key, self::$storage));
    }

    // Получить ключ
    protected static function getKey(string $config, int $preend): string
    {
        // Если равен 1 или 2, тогда получаем первое вхождение
        if ($preend == 1 || $preend == 2) {
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
