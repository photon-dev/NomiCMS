<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\App;

// Использовать
//use System\Container\Container;

/**
 * Интерфейс AppInterface
 */
interface AppInterface
{
    // Получить GET параметры
    public function getParams();

    // Получить информацию о маршруте
    public function getRoute(): array;

}
