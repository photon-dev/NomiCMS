<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Html;

/**
 * Интерфейс SeoInterface
 */
interface SeoInterface
{
    // Получить путь к исходному файлу
    public function get(): array;
}
