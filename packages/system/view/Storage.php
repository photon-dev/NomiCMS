<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\View;

// Использовать
//use System\View\TemplateInterface;
use Exception;

/**
 * Класс предназначен для хранения данных, используемых потом в html коде
 *
 * @version 1.0
 */
class Storage //implements TemplateInterface
{
    // Для всех
    protected static $everyone = [];

    // Для некоторых, или одиночки
    protected static $some = [];

    // Добавить
    public static function add(array $data, $templates = false)
    {
        // Сохранить для всех
        if ($templates === false) {
            return self::setAll($data);
        }

        // Сохранить для одноко
        if (is_string($templates)) {
            return self::set($data, $templates);
        }

        // Сохранить некоторых одиночки
        if (is_array($templates)) {
            return self::setSome($data, $templates);
        }

        throw new Exception('Переменная templates должна быть false, строкой, массивом ' . gettype($templates));
    }

    // Установить для всех
    protected static function setAll(array $data): void
    {
        self::$everyone = array_merge(self::$everyone, $data);
    }

    // Установить для одиночки
    protected static function set(array $data, string $template): void
    {
        if (isset(self::$some[$template])) {
            self::$some[$template] = array_merge(self::$some[$template], $data);
        } else {
            self::$some[$template] = $data;
        }
    }

    // Установить для некоторых
    protected static function setSome(array $data, array $templates): void
    {
        // Разобрать список выбранных шаблонов
        foreach ($templates as $template) {
            if (isset(self::$some[$template])) {
                self::$some[$template] = array_merge(self::$some[$template], $data);
            } else {
                self::$some[$template] = $data;
            }
        }
    }

    // Получить все всех, или одиночки
    public static function get($template = false): array
    {
        if ($template && isset(self::$some[$template])) {
            return self::$some[$template];
        }

        return self::$everyone;
    }
}
