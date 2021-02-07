<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Json;

// Использовать
use System\Json\JsonCreate;
use System\Json\JsonOpen;

// Контейнер
class Json //implements ContainerInterface
{
    // Полный путь
    protected static $path = '';

    // Имя файла
    protected static $fileName = '';

    // Обработчик
    public static function __callStatic(string $action, array $params)//: void
    {
        self::$path = $params[0];

        self::$fileName = $params[1];

        return self::$action();
    }

    // Создать файл json
    protected static function create()
    {
        return new JsonCreate(self::$path, self::$fileName);
    }

    // Открыть файл json
    protected static function open()
    {
        return new JsonOpen(self::$path, self::$fileName);
    }
}
