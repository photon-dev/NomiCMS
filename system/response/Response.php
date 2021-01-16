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
use System\Response\ResponseInterface;
use System\Response\ResponseCodes;

use InvalidArgumentException;
use Exception;

/**
 * Класс Response
 */
class Response extends ResponseCodes implements ResponseInterface
{
    // Код ответа сервера
    protected $status;

    // Http заголовки
    protected $headers = [];

    // Тип содержимого
    protected $contentType;

    // Кеширование
    protected $cache = false;

    // Тело ответа
    protected $body = '';

    // Ответ отправлен
    protected $sent = false;

    // Конструктор
    public function __construct(int $status = 200)
    {
        $this->status = $this->invalidStatus($status);

    }

    // Получить статус
    public function getStatus(): int
    {
        return $this->status;
    }

    // Cодержимое
    public function body(string $body)
    {
        $this->body = $body;
    }

    // Записать в содержимое
    public function write($str)
    {
        $this->body .= $str;
    }

    // Отправить содержимое
    public function send()
    {
        if ($this->sent === false) {
            $this->sent = true;

            echo $this->body;
        }
    }

    // Получить содержимое
    public function getBody()
    {
        return $this->body;
    }

    // Очистка ответа.
    public function clear() {
        $this->status = 200;
        $this->headers = [];
        $this->body = '';

        return $this;
    }


    public function invalidStatus($status)
    {
        if (!is_integer($status) || $status < 100 || $status > 599) {
            throw new InvalidArgumentException("Недопустимый код состояния HTTP: {$status}");
        }

        return $status;
    }

    public function getStatusCode($id = false)
    {
        if ($id === false) {
            //var_dump($id);
            return $this->status;
        }

        if (array_key_exists($id, self::$codes)) {
            return $id;
        } else {
            throw new Exception("Неверный код состояния HTTP: {$id}");
        }

        return $this;
    }


}
