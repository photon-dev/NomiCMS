<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http;

/**
 * Класс Ipus
 */
class Ipus
{
	// Получить ip-адрес
	public static function getIp(): string
	{
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} elseif (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } else {
			$ip = $_SERVER['REMOTE_ADDR'];
        }

		return filter_var($ip, FILTER_VALIDATE_IP);
	}

	// Обработать ip-адрес через long2ip
	public static function to(string $ip = ''): int
	{
		if (empty($ip)) {
			return ip2long(self::getIp());
		}

		return ip2long($ip);
	}

	// Обработать ip-адрес через ip2long
	public static function up(int $ip): string
	{
		return long2ip($ip);
	}
}
