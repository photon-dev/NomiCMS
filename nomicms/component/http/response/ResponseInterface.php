<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Response;

// Класс ResponseInterface
interface ResponseInterface
{
    // Проверить статус на валидность
    public function invalidStatus(int $status): int;

    // Проверить статус
    public function hasStatus(int $status): bool;

    // Проверить заголовок
    public function hasHeader(string $name): bool;

    // Установить статус
    public function setStatus(int $status = 200): self;

    // Установить заголовок
    public function setHeader(string $name, string $desc): self;

    // Установить заголовки
    public function setHeaders(array $headers): self;

    // Установить тип содержимого
    public function setContentType(string $mime): self;

    // Установить тело
    public function body(string $str): self;

    // Записать в содержимое
    public function write(string $str): self;

    // Проверить статус ответа
    public function getStatus(): int;

    // Получить статус
    public function getHeaders(): array;

    // Получить тело
    public function getBody(): string;

    // Получить содержимое
    public function getContent(): string;

    // Тип содержимого
    public function getContentType(): string;

    // Отправились заголовки или нет
    public function sentHeaders(): bool;

    // Отправить содержимое
    public function send(bool $sendHeaders = true);
}
