<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Http\Request;

// Использовать
use Nomicms\Component\Http\Request\RequestFactory;
use Nomicms\Component\Http\Request\RequestException;

/**
 * Request
 */
class Request
{
    public function __construct(){}

    public function __get(string $name): RequestFactory
    {
        // Получить доступные методы
        $method = $this->getMethods();

        // Проверить метод и получить данные
        if (isset($method[$name]) === false) {
            throw new RequestException("Метод {$name} не определён");
        }

        // Создать фабрику запроса, отправить данные
        return new RequestFactory($method[$name]);
    }

    // Получить список доступных методов
    protected function getMethods(): array
    {
        return [
            'get' => $_GET,
            'post' => $_POST,
            'files' => $_FILES
        ];
    }

}
