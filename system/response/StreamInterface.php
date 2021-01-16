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

interface StreamInterface
{
    public function __toString();

    public function close();

    public function detach();

    public function getSize();

    public function tell();

    public function eof();

    public function isSeekable();

    public function seek($offset, $whence = SEEK_SET);

    public function rewind();

    public function isWritable();

    public function write($string);

    public function isReadable();

    public function read($length);

    public function getContents();

    public function getMetadata($key = null);
}
