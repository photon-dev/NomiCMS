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
 * Интерфейс TemplateInteface
 */
interface TemplateInteface
{
    // Установить
    public function set(...$set): bool;

    // Получить для всех
    public function setAll($data): void;
}
