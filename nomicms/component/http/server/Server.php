<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Server;

// Использовать
use Exception;

// Класс Server
class Server {

	public static function ajax()
	{
		return  self::get('HTTP_X_REQUESTED_WITH') !== null &&
                strtolower(self::get('HTTP_X_REQUESTED_WITH')) === 'xmlhttprequest';
	}

    // Проверить
    public static function has(string $name): bool
    {
        return isset(self::server()[$name]);
    }

    // Получить
    public static function get(string $name = '')
    {
        if (! self::has($name)) {
            throw new Exception("SERVER {$name} не определён");
        }

        return self::server()[$name];
    }

    public static function server()
    {
        return $_SERVER;
    }
}
