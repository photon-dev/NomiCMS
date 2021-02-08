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
use System\View\Storage;

/**
 * Класс Template
 */
class Template extends Storage//implements TemplateInterface
{
    // Для всех
    protected static $everyone = [];

    // Для некоторых, или одиночки
    protected static $some = [];

    // Добавить
    public static function add(array $data, $templates = false)
    {
        return parent::add($data, $templates);
    }

    // Получить все всех, или одиночки
    public static function get($template = false): array
    {
        return parent::get($template);
    }
}
