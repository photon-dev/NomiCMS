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
 * Класс Пакет
 */
class Package
{
    // Текущий маршрут
    protected $route = [];

    public function __construct()
    {
        //$route = $this->container->get('config')->get('route');
        //$this->route = $route;
    }

    // Получить GET параметры
    public function getParams()
    {
        return $this->route['params'];
    }

    // Существует ли пакет
    public function hasPackage()
    {
        return is_dir(PACKS . $this->route['package'] . '/');
    }

    // Существует ли исходный файл
    public function hasSource()
    {
        return file_exists(PACKS . $this->getPathSource());
    }

    // Получить путь к исходному файлу
    public function getPathSource()
    {
        return $this->route['package'] . '/src/' . $this->route['src'] . '.php';
    }
}
