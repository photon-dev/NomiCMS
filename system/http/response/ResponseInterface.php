<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Response;

/**
 * Класс ResponseInterface
 */
interface ResponseInterface
{
    // Установить тело
    public function body(string $str): void;

    // Записать в содержимое
    public function write(string $str): void;

    // Получить тело
    public function getBody(): string;

    // Получить содержимое
    public function getContent(): string;

    // Проверить статус ответа
    public function getStatus(): int;

    // Установить статус
    public function setStatus(int $status): void;

    // Проверить статус ответа
    public function hasStatus(int $status);

    // Отправить содержимое
    public function send();
}
