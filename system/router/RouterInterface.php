<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Router;

/**
 * Класс Маршрутизатора
 */
interface RouterInterface
{
    // Получить информацию о маршруте
    public function getRoute();

    // Получить статус маршрута
    public function getFound();
}
