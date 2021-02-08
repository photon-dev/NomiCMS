<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Response;

// Использовать
use System\Http\Response\ResponseMimeTypes;

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
