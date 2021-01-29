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
use System\App\Package;
use System\App\AppInterface;
use System\App\Factory;

/**
 * Класс NomiApp
 */
class NomiApp extends Package implements AppInterface
{
    // Контейнер
    protected $container;

    // Системные настройки
    protected $config = [];

    // Найден
    protected $found = false;

    // Страница найдена
    public const FOUND = true;
    // Страница не найдена
    public const NOT_FOUND = false;

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;

        $this->config = $container->get('config.config')->pull('config', 'system/config');

        /* $this->router();*/

        // Сохранить если true маршрут найден
        //$this->found = $router->getFound();
        /*
        if ($this->found) {
            parent::__construct($router->getRoute());
        }
        */
    }

    // Настроить приложение
    public function configure()
    {
        if ($env = $app->getEnvironment($this->config['env'])) {
            loadFile('config/boot/' . $env);
        } else
            die();
    }

    // Запустить маршрутизатор
    public function router()
    {

        // Получить доступные маршруты
        $routes = loadFile('config/routes');

        // Получить маршрутизатор
        $router = $this->container->get('router', [
            'routes' => $routes($this->container)
        ]);
    }

    // Получить среду окружения
    public function getEnvironment(string $env)
    {
        // Установить среду окружения
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
