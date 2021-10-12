<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Response;

// Использовать
use Nomicms\Component\Http\Response\ResponseMimeTypes;

/**
 * Класс ResponseCodes
 */
class ResponseCodes extends ResponseMimeTypes
{
    public static $codes = [
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
        502 => 'Bad Gateway'
    ];
}
