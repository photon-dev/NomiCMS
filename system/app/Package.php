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

    // Найден маршрут
    protected $found = false;

    // Конструктор
    public function __construct(){}

    // Получить текущий маршрут
    public function getRoute(): array
    {
        return $this->route['params'];
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
        return is_dir(PACKS . $this->route['package'] . '/');
    }

    // Существует ли исходный файл
    public function hasSource(): bool
    {
        return file_exists(PACKS . $this->getPathSource());
    }
}
