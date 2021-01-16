<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Response;

/**
 * Класс ResponseInterface
 */
interface ResponseInterface
{
    public function getStatus(): int;

    public function getStatusCode($id);

    public function getBody();

    public function body(string $str);

    public function send();

    public function write($str);

    //public function withStatus($code, $reasonPhrase = '');

    //public function getReasonPhrase();
}
