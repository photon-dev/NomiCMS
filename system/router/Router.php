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
use System\Router\RouterInterface;
use System\Config\Config;

/**
 * Класс маршрутизации
 */
class Router extends RouteParse implements RouterInterface
{
    // Текущий маршрут
    private $route = [];

    // Пакет по умолчанию
    protected $package = '/';

    // Найти маршрут
    protected $found = false;

    // Конструктор
    public function __construct(array $routes = [], Config $config)
    {
        // Получить пакет по умолчанию
        $package = $config->get('config')['default_package'];

        // Установить пакет
        if ($this->package !== $package) {
            $this->package = $package;
        }

        // Разобрать маршруты
        $this->parse($routes);
    }

    // Разобрать маршруты
    protected function parse(array $routes): void
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = $this->getCurrentUri($uri);

        // Разбор маршрутов
        foreach ($routes as $route) {

            //  || strpos($route['url'], '{') !== false
            if (strstr($route['url'], '{') !== false) {
                $route['url'] = $this->parseUrl($route['url']);
            }

            // Если маршрут найден
            if (preg_match('#^' . $route['url'] . '$#', $uri, $matches)) {

                // Получить указаный url
                $currentUrl = $matches[0];
                array_shift($matches);

                // Сохранить информацию о маршруте
                $this->route = [
                    'url' => $currentUrl,
                    'package' => $route['package'],
                    'src' => $route['src'],
                    'params' => $route['params'] ?? false,
                    'matches' => ($matches) ? $matches : false
                ];

                // Установить что найден
                $this->found = true;
                break;
            }
        }
    }

    // Проверить совпадения
    protected function match(): array
    {
        $params = [];

        foreach ($this->route['matches'] as $key => $value) {
            $params[$this->route['params'][$key]] = $value;
        }

        return $params;
    }

    // Получить параметры
    protected function getParams(): void
    {
        // Если параметры указаны, обработать и собрать в кучу все совпадения
        if ($this->found && $this->route['params'] && isset($this->route['matches'])) {
            $this->route['params'] = $this->match();

        }
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
            // Получить параметры
            $this->getParams();

            unset ($this->route['matches']);
            return $this->route;
        }

        return [];
    }
}
