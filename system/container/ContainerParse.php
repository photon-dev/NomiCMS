<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Container;

/**
 * Класс ContainerParse
 */
class ContainerParse
{
    // Получить имя зависимости
    // mb_strtolower преобразует строку в нижний регистр
    public function getName(string $name): string
    {
        $name = str_replace(['System\\', '\\'], ['', '.'], $name);

        return mb_strtolower($name);;
    }
}
