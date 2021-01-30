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
    protected $system = [];

    // Настройки пакета
    protected $settings = [];

    // Текущий маршрут
    protected $route = [];

    // Найден
    protected $found = false;

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;

        $config = $container->get('config.config');

        // Загрузить настройки системы
        $this->system = $config::get('system');

        // Загрузить настройки пакета
        $this->settings = $config::pull($this->system['default_package'] . '/config/settings', PACKAGE);

        /* dd($this->settings);*/
    }

    // Запустить маршрутизатор
    protected function router()
    {
        // Получить доступные маршруты
        $routes = loadFile('config/routes');

        // Получить маршрутизатор
        $router = $this->container->get('router.router', [
            'routes' => $routes($this->container),
            'package' => $this->system['default_package']
        ]);

        return $router;
    }

    // Настроить приложение
    public function configure()
    {
        // Запустить маршрутизатор
        $router = $this->router();

        $this->found = $router->getFound();

        if ($this->found) {
            $this->route = $router->getRoute();
        }

        dd($this->route);
    }

    // Запустить приложение
    public function run()
    {
        // Если маршрут найден, сообщить об этом
        //if ($this->found) {
            //return true;
        //}

        // Показать ошибку
        return 'Приложение запущено';
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
