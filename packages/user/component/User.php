<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\User\Component;

// Использовать
use System\Container\ContainerInterface;
use System\Database\DB;

/**
 * Класс User
 */
class User
{
    // Контейнер
    protected $container;

    // Данные пользователя
    protected $user = [];

    // Авторизован
    public $logger = false;

    // Проверка на бан
    public $banned = false;

    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;

    }

    protected function logon()
    {

    }

    public function has($has): bool
    {
        return isset($has);
    }

    // Получить данные пользователя
    public function getUser(): array
    {
        if ($this->logger && isset($this->user->uid)) {
            return $this->user;
        }

        return [];
    }

}
