<?php
/**
 * Класс маршрутизации
 */
class Routing
{
    // Маршруты
    public $routes = array();

    // Неудача, откладка ощибок
    public $failure = false;

    public function __construct($routes = [])
    {
        if (is_array($routes))
            $this->routes = $routes;
    }

    public function run()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route)
        {
            if (preg_match('#^' . $route['url'] . '$#u', $uri, $match))
            {
                return array(
                    'module' => $route['module'] ?? 'index',
                    'src' => $route['src'] ?? 'index',
                    'get' => $route['get'] ?? false,
                    'match' => $match
                );
                break;
            }
        }
    }

    public function match($get, $match)
    {
        $vars = [];

        foreach ($match as $key => $value)
            $vars[$get[$key]] = $value;

        return $vars;
    }

    public function __destruct()
    {
        if ($this->failure)
        {
            //ob_start();
            //header('Location: /error/404');
            //header('Location: /');
            exit;
        }
    }
}
