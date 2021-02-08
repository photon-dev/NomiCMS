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

    // Отправить содержимое
    public function send();

    // Получить статус
    public function getStatus(): int;

    // Получить тело
    public function getBody();

    // Получить содержимое
    public function getContent();

    // Получить код статуса
    public function getStatusCode($id);

}
