<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\App;

// Использовать
use System\Container\ContainerInterface;
use System\Router\Router;

/**
 * Класс AppConfigure
 */
class AppConfigure
{
    // Текущий маршрут
    protected $route = [];

    // Найден маршрут
    protected $found = false;

    // Конструктор
    public function __construct()
    {
        // Загрузить доступные маршруты
        $routes = config('config/routes');

        // Получить маршрутизатор
        $router = $this->container->get('router', [
            'routes' => $routes($this->container)
        ]);

        // Если маршрут найден
        if ($router->getFound()) {
            // Получить маршрут
            $this->route = $router->getRoute();

            // Сохранить маршрут
            $this->container->get('config')::add('route', $this->route);
            
            // Загрузить настройки пакета
            $this->settings = $this->container->get('config')::pull($this->route['package'] . '/settings', PACKAGE);

            // Установить как запущено
            $this->found = true;
        }
    }

    // Получить GET параметры
    public function getParams()
    {
        return $this->route['params'];
    }

    // Получить путь к исходному файлу
    public function getPathSource(): string
    {
        return $this->route['package'] . '/src/' . $this->route['src'] . '.php';
    }

    // Существует ли пакет
    public function hasPackage(): bool
    {
        if (! $this->status) {
            return is_dir(PACKS . $this->route['package'] . '/');
        }

        return false;
    }

    // Существует ли исходный файл
    public function hasSource(): bool
    {
        if (! $this->status) {
            return file_exists(PACKS . $this->getPathSource());
        }

        return false;
    }
}
