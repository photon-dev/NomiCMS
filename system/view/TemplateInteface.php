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
    // Установить для выбранного шаблона
    public function set(string $key, $data, string $flag = ''): self;

    // Установить для всех шаблонов
    public function setAll($data, string $key = ''): self;

    // Проверить
    public function has(string $key): bool;

    // Рендерить
    public function get(string $template);

}
