<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Response;

// Использовать
use System\Http\Response\ResponseInterface;
use System\Http\Response\ResponseCodes;

use Exception;

/**
 * Класс Response
 */
class Response extends ResponseCodes implements ResponseInterface
{
    // Код ответа сервера
    protected $status;

    // Тело
    protected $body = '';

    // Контент
    protected $content = '';

    // Ответ отправлен
    protected $sent = false;

    // Конструктор
    public function __construct(array $options = [])
    {
        $status = isset($options['status']) ? $options['status'] : 200;

        $this->status = $this->invalidStatus($status);
    }

    // Проверить статус на валидность
    public function invalidStatus(int $status): int
    {
        if ($status < 100 || $status > 599) {
            throw new Exception("Недопустимый код состояния HTTP: {$status}");
        }

        return $status;
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

    public function sendHeaders()
    {
        if (! headers_sent()) {

            return true;
        }

        return false;
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

    // Получить статус
    public function getStatus(): int
    {
        return $this->status;
    }

    // Установить статус ответа
    public function setStatus(int $status): void
    {
        $this->status = $this->invalidStatus($status);
    }

    // Получить код статуса
    public function hasStatus(int $status)
    {
        if (! isset(self::$codes[$status])) {
            throw new Exception("Неверный код состояния HTTP: {$status}");
        }
    }

    // Отправить содержимое
    public function send()
    {
        // Проверить статус
        $this->hasStatus($this->status);

        // Установить код ответа
        http_response_code($this->status);

        // Если sent false отправить тело
        if ($this->sent === false) {
            $this->sent = true;

            echo $this->body;
        }
    }

}
