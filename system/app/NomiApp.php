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
use System\Router\RouterInterface;
use System\App\Package;
use System\App\AppInterface;
use System\App\Factory;

/**
 * Класс PHPoint
 */
class NomiApp extends Package implements AppInterface
{
    // Контейнер
    protected $container;

    // Найден
    protected $found = false;

    // Страница найдена
    public const FOUND = true;
    // Страница не найдена
    public const NOT_FOUND = false;

    // Конструктор
    public function __construct(ContainerInterface $container, RouterInterface $router)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Сохранить если true маршрут найден
        $this->found = $router->getFound();

        if ($this->found) {
            parent::__construct($router->getRoute());
        }
    }

    // Получить среду окружения
    public function getEnvironment($env)
    {
        if ($env == 'dev' || $env == 'product') {
            return $env;
        }

        return false;
    }

    // Запустить приложение
    public function run()
    {
        // Если маршрут найден, сообщить об этом
        if ($this->found) {
            return true;
        }

        // Показать ошибку
        return false;
    }

    // Показать ошибку
    public function notFound($error)
    {
        return error($error);
    }

    // Получить о текущей версии
    public function getVersion()
    {
        if (file_exists(ROOT . 'VERSION')) {

            return file_get_contents(ROOT . 'VERSION');
        }

        return 'v3.0.1601b';
    }
}
