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
 * Класс фабрика запросов
 */
class Request
{
    // Данные get
    protected $request;

    public function __construct(Request $request = null)
    {
        //$this->request = $request ?: new request();
    }

    public function __get(string $name): RequestFactory
    {
        $method = $this->getMethods();

        // Проверить метод и получить данные
        if (isset($method[$name])) {

            // Создать фабрику запроса
            $factory = new RequestFactory($method[$name]);

            // Отправить данные
            return $factory;
        }

        throw new RequestException("Метод {$name} не определён");
    }

    protected function getMethods(): array
    {
        return [
            'get' => $_GET,
            'post' => $_POST,
            'files' => $_FILES
        ];
    }

}
