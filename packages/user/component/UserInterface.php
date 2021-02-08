<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\User\Component;

/**
  * Интерфейс User
  */
interface ContainerInterface
{
    // Получить пользователя
    public function getUser(): array;
}
