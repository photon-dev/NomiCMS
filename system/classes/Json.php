<?php
/**
 * Класс Json
 */
class Json
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
