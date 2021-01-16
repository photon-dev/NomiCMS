<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Container;

// Интерфейс контейнера
interface ContainerInterface
{
    // Установить службу
    public function set($service);

    // Получить службу
    public function get(string $name, array $params = []);

     // Проверить существует служба
    public function has(string $name);

    // Получить список установленных служб
    public function getInstalled();

    // Получить список используемых служб
    public function getUsed();
}
