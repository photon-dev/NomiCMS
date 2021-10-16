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
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Text\Misc;
use Nomicms\Component\View\View;

/**
 * Класс User
 */
class UserParams
{
    public static function getLogin(string $uid, ContainerInterface, $container)
    {
        $uid = Misc::abs($uid);
        $container->get('db')->query('SELECT login FROM user WHERE uid "' . $uid . '"');

        if (! $result->fetch_assoc()) {
            return 'DELETED';
        }
    }
}
