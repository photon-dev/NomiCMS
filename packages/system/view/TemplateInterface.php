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
 * Интерфейс View
 */
interface TemplateInterface
{
    // Добавить
    public static function add(array $data, $templates = false);

    // Получить все всех, или одиночки
    public static function get($template = false): array;
}
