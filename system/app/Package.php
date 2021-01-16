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
    private $route = [];

    // Пакет (по умолчанию main)
    private $package = 'main';

    // Источник (по умолчанию index)
    private $src = 'index';

    public function __construct(array $route)
    {
        $this->route = $route;

        $this->package =  $route['package'];
        $this->src =  $route['src'];
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
