<?php
declare(strict_types=1);

namespace System\Response;

// Использовать
use System\Response\ResponseInterface;
use System\Response\ResponseCodes;

use Exception;

abstract class Message //implements MessageInterface
{
    protected $protocol = '1.1';

    protected static $validProtocol = [
        '1.0' => true,
        '1.1' => true,
        '2.0' => true,
        '2' => true,
    ];
}
