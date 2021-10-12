<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Config;

// Использовать
use Nomicms\Component\Config\Exception\ConfigNotFound;

/**
 * Класс Config
 */
class Config
{
    protected static $storage = [];

    // Получить
    public static function get(string $key)
    {
        // Проверка по ключу
        if (self::has($key) === false) {
            throw new ConfigNotFound("Ключ: {$key} не обнаружен");
        }

        return self::$storage[$key];
    }

    // Добавить в хранилище
    public static function add(string $key, array $data, bool $output = true)
    {
        // Проверка по ключу
        if (self::has($key) === true) {
            throw new ConfigNotFound("Ключ: {$key} уже занят");
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
        // root/packages/
        if ($preend == 1) {

            $path = PACKAGES;

        // root/themes/
        } elseif ($preend == 2) {

            $path = THEMES;

        // nomicms/config/
        } else {
            $path = CONFIG;
        }

        return config($file, $path);
    }

    // Проверка значения
    protected static function has(string $key): bool
    {
        return (isset(self::$storage[$key]) && array_key_exists($key, self::$storage));
    }

    // Получить ключ
    protected static function getKey(string $config, int $preend): string
    {
        // Получить первое вхождение, если $preend 1, 2
        if ($preend == 1 || $preend == 2) {
            return substr($config, 0, strpos($config, '/'));
        }

        // Получить последнее вхождение
        if (strrpos($config, '/') !== false) {
            return substr($config, strrpos($config, '/') + 1);
        }

        return $config;
    }

    // Получить все данные
    public static function getStorage()
    {
        return self::$storage;
    }
}
