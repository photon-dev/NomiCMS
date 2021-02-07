<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Http\Request;

// Использовать
use System\Http\Request\RequestFactory;
use System\Http\Request\RequestException;

/**
 * Класс Request
 */
class Request
{
    public function __construct(){}

    // Получить
    public function __get(string $name): RequestFactory
    {
        // Получить список методов
        $method = $this->getMethods();

        // Проверить метод
        if (isset($method[$name]) === false) {
            throw new RequestException("Метод {$name} не определён");
        }

        // Создать фабрику запроса
        $factory = new RequestFactory($method[$name]);

        // Отправить данные
        return $factory;
    }

    // Список методов получения запросов
    protected function getMethods(): array
    {
        return [
            'get' => $_GET,
            'post' => $_POST,
            'files' => $_FILES
        ];
    }

}
