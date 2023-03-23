<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Response;

// Использовать
use Nomicms\Component\Http\Response\ResponseInterface;
use Nomicms\Component\Http\Response\ResponseCodes;
use Nomicms\Component\Http\Server\Server;

use Exception;

// Класс Response
class Response extends ResponseCodes implements ResponseInterface
{
    // Код ответа сервера
    protected $status = 200;

    // Заголовки
    protected $headers = [];

    // Тип контента
    protected $contentType = 'text/html';

    // Кодировка
    protected $charset = 'utf-8';

    // Тело
    protected $body = '';

    // Контент
    protected $content = '';

    // Ответ отправлен
    protected $sent = false;

    // Конструктор
    public function __construct(array $options = [])
    {
        $this->status = $this->invalidStatus(
            $options['status'] ?? 200
        );
    }

    // Проверить статус на валидность
    public function invalidStatus(int $status): int
    {
        if ($status < 100 || $status > 511) {
            throw new Exception("Недопустимый статус {$status} должно быть от 100 до 511");
        }

        if (! $this->hasStatus($status)) {
            throw new Exception("Статус {$status} не найден");
        }

        return $status;
    }

    // Проверить статус
    public function hasStatus(int $status): bool
    {
        return  isset(self::$codes[$status]) &&
                array_key_exists($status, self::$codes);
    }

    // Проверить заголовок
    public function hasHeader(string $name): bool
    {
        return  isset($this->headers[$name]) &&
                array_key_exists($name, $this->headers);
    }

    // Установить статус
    public function setStatus(int $status = 200): self
    {
        $this->status = $this->invalidStatus($status);
        return $this;
    }

    // Установить заголовки
    public function setHeader(string $name, string $desc): self
    {
        if ($this->hasHeader($name)) {
            throw new Exception("Заголовок {$mime} указан");
        }

        $this->headers[$name] = $desc;
        return $this;
    }

    // Установить заголовки
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    // Установить тип содержимого
    public function setContentType(string $mime): self
    {
        if (! isset(self::$mimeTypes[$mime]) && ! array_key_exists($mime, self::$mimeTypes))
        {
            throw new Exception("Недопустимый mimeTypes {$mime}");
        }

        $this->contentType = self::$mimeTypes[$mime];
        return $this;
    }

    // Установить тело
    public function body(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    // Записать в содержимое
    public function write(string $str): self
    {
        $this->content .= $str;
        return $this;
    }

    // Получить статус
    public function getStatus(): int
    {
        return $this->status;
    }

    // Получить статус
    public function getHeaders(): array
    {
        return $this->headers;
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

    // Тип содержимого
    public function getContentType(): string
    {
        return $this->contentType;
    }

    // Отправились заголовки или нет
    public function sentHeaders(): bool
    {
        return headers_sent();
    }

    // Отправить заголовки
    protected function sendHeaders(): bool
    {
        if (headers_sent()) {
            return false;
        }

        // Send the protocol/status line first, FCGI servers need different status header
		if (Server::has('FCGI_SERVER_VERSION'))
		{
			header('Status: ' . $this->status . ' ' . self::$codes[$this->status]);
		} else {
            $protocol = Server::get('SERVER_PROTOCOL') ? Server::get('SERVER_PROTOCOL') : 'HTTP/1.1';
			header($protocol . ' ' . $this->status . ' ' . self::$codes[$this->status]);
        }

        foreach ($this->headers as $name => $value) {

            is_string($name) and $value = "{$name}: {$value}";
            header($value, true);
        }

        return true;
    }

    // Отправить содержимое
    public function send(bool $sendHeaders = true)
    {
        // Отправить заголовки?
        if ($sendHeaders) {
            $this->sendHeaders();
		}

        //http_response_code($this->status);

        header("Content-Type: {$this->contentType}; charset={$this->charset}", true);

        // Если sent false отправить тело
        if ($this->sent === false) {
            $this->sent = true;

            echo $this->body;
        }
    }
}
