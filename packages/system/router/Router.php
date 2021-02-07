<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Router;

// Использовать
use System\Router\RouteParse;

/**
 * Класс маршрутизации
 */
class Router extends RouteParse
{
    // Текущий маршрут
    protected $route = [];

    // Найти маршрут
    protected $found = false;

    // Конструктор
    public function __construct(array $routes = [])
    {
        // Если url-адрес равен '/'
        if ($this->getCurrentUri() == '/') {

            // Поиск маршрута по умолчанию
            if ($key = array_search('/', array_column($routes, 'url'))) {

                // Сохранить маршрут
                $this->route = $routes[$key];
                // Сообщить что маршрут найден
                $this->found = true;
            } else {
                die('<b>Маршрут по умолчанию не найден.</b><br />Проверьте правильность настройки маршрутизации...');
            }
        }

        if ($this->found === false) {
            $this->parse($routes);
        }
    }

    // Разобрать маршруты
    protected function parse(array $routes): void
    {
        // Получить url-адрес
        $uri = $this->getCurrentUri();

        // Разбор маршрутов
        foreach ($routes as $route) {

            // Проверить если первом вхождении подстроки
            // Ищем символ {
            if (strpos($route['url'], '{') !== false) {
                $route['url'] = $this->parseUrl($route['url']);
            }

            // Если маршрут найден
            if (preg_match('#^' . $route['url'] . '$#', $uri, $matches)) {

                // Получить указаный url
                $currentUrl = $matches[0];
                array_shift($matches);

                // Если совпадения, и параметры найдены
                if (isset($matches) && isset($route['params'])) {
                    $params = $this->match($matches, $route['params']);
                }

                // Созранить информацию о маршруте
                $this->route = [
                    'url'       => $currentUrl,
                    'package'   => $route['package'],
                    'src'       => $route['src'],
                    'params'    => $params ?? false
                ];

                // Установить что найден
                $this->found = true;
                break;
            }
        }
    }

    // Проверить совпадения
    protected function match(array $matches, array $params): array
    {
        // Совместить параметры с совпадениями
        foreach ($matches as $key => $value) {
            $params[$params[$key]] = $value;

            unset($params[$key]);
        }

        // Показать параметры
        return $params;
    }

    // Получить найден ли маршрут
    public function getFound(): bool
    {
        return $this->found;
    }

    // Получить полную информацию о маршруте
    public function getRoute(): array
    {
        // Если маршрут найден
        if ($this->found) {

            // Показать маршрут
            return $this->route;
        }

        return [];
    }
}
