<?php
/**
 * Класс маршрутизации
 */
class Routing
{
    // Все маршруты
    protected $routes = [];

    // Текущий маршрут
    protected $route = [];

    // Найти маршрут
    public $found = false;

    // Конструктор
    public function __construct(array $routes = [])
    {
        $this->routes = $routes;

        /*
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
        */
        //if ($this->found === false) {
            //$this->parse($routes);
        //}
    }

    // Обработка строки браузера
    protected function parseUrl(string $url)
    {
        $data = [
            '{num}' => '(\d+)',      // Цифры
            '{any}' => '([^/]+)',    // Все символы без знака '/'
            '{all}' => '(.*)',       //Все символы
            '{str}' => '(\w+)',      //Буквенно-цифровые символы
            '{slug}' => '([\w\-_]+)' //Символы формата URL для SEO. (Буквенно-цифровые символы, _ и -)
        ];

        $keys = array_keys($data);
        $values = array_values($data);

        return str_replace($keys, $values, $url);
    }

    // Получить url-адрес из строки браузера
    protected function getCurrentUri(string $uri = '')
    {
        // Если url не указан получаем его
        if (empty($uri)) {
            $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }

        // Удалить все что находиться после ?
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }

    // Разобрать маршруты
    public function run()
    {
        // Получить url-адрес
        $uri = $this->getCurrentUri();

        // Разбор маршрутов
        foreach ($this->routes as $route) {

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
                    'module'   => $route['module'] ?? 'main',
                    'src'       => $route['src'] ?? 'index',
                    'params'    => $params ?? false
                ];

                // Установить что найден
                $this->found = true;

                return true;
                break;
            }
        }
    }

    // Проверить совпадения
    protected function match(array $matches, array $params)
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
    public function getFound()
    {
        return $this->found;
    }

    // Получить полную информацию о маршруте
    public function getRoute()
    {
        // Если маршрут найден
        if ($this->found) {

            // Показать маршрут
            return $this->route;
        }

        return [];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function __dectruct(){}
}
