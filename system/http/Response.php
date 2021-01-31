<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http;

// Использовать
use System\Http\ResponseInterface;
use System\Http\ResponseCodes;

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

    // Тело ответа
    protected $content = '';

    // Ответ отправлен
    protected $sent = false;

    // Конструктор
    public function __construct(int $status = 200)
    {
        $this->status = $this->invalidStatus($status);

    }

    // Установить тело
    public function body(string $body): void
    {
        $this->body = $body;
    }

    // Записать в содержимое
    public function write(string $str): void
    {
        $this->content .= $str;
    }

    // Отправить содержимое
    public function send()
    {
        if ($this->sent === false) {
            $this->sent = true;

            echo $this->body;
        }
    }

    public function setHeader(string $name, $value, $replace = true)
    {
        $this->headers[$name] = $value;
    }

    // Получить статус
    public function getStatus(): int
    {
        return $this->status;
    }

    // Получить тело
    public function getBody(): string
    {
        return $this->body;
    }

    // Получить содержимое
    public function getContent(): string
    {
        return $this->content;
    }

    // Очистить все
    public function clear(): self
    {
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

    // Получить код статуса
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
