<?php
<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Response;

// Использовать
use System\Response\StreamInterface;

interface MessageInterface
{
    public function getProtocolVersion();

    public function withProtocolVersion($version);

    public function getHeaders();

    public function hasHeader($name);

    public function getHeader($name);

    public function getHeaderLine($name);

    public function withHeader($name, $value);

    public function withAddedHeader($name, $value);

    public function withoutHeader($name);

    public function getBody();

    public function withBody(StreamInterface $body);
}
