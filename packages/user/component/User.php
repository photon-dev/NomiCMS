<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\User;

// Использовать
use System\Container\ContainerInterface;
use System\Database\DB;

/**
 * Класс User
 */
class User
{
    // Данные пользователя
    protected $user = [];

    // Авторизован
    public $logger = false;

    // Проверка на бан
    public $banned = false;

    public function __construct() {

    }

    protected function logon()
    {
        $session = $_SESSION['nickname'] ?? false;
        $login = $_COOKIE['nickname'] ?? false;
        $password = $_COOKIE['password'] ?? false;

        if ($session) {
            return $session;
        } else if ($login && $password) {
            return [
                $login, $password
            ];
        }
    }

    public function has($has): bool
    {
        return isset($has);
    }

    // Получить данные пользователя
    public function getUser()
    {
        $uid = $this->user['uid'];

        if ($this->logger && $this->has($uid)) {
            return $this->user;
        }

        return false;
    }

}
