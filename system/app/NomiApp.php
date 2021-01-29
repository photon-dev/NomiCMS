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

        // Загрузить настройки системы
        $this->config = $container->get('config.config')->pull('config', 'system/config');;

        /* $this->router();*/

        // Сохранить если true маршрут найден
        //$this->found = $router->getFound();
        /*
        if ($this->found) {
            parent::__construct($router->getRoute());
        }
        */
    }

    // Получить среду окружения
    public function setEnv(): void
    {
        // Определить, установить среду
        if (getEnvironment($this->config['env'])) {

            loadFile('config/boot/' . $this->config['env']);

        // Показать ошибку
        } else
            die('Среда окружения не может быть определена');
    }

    // Установить сессию, и получить ее id
    protected function setSession(): string
    {
        // Иницилизировать сессии
        session_name($this->config['session_name']) or die('Невозможно инициализировать сессии');
        session_start() or die('Невозможно инициализировать сессии');
        session_reset();

        // Показать id сессии
        return preg_replace('#[^a-z0-9]#i', '', session_id());
    }

    // Настроить приложение
    public function configure()
    {
        $this->setEnv();

        // Установка временной зоны
        if ($this->config['timezone'] != date_default_timezone_get()) {
            date_default_timezone_set($this-config['timezone']);
        }

        // Установить сессию, и получить ее id
        $sessionId = $this->setSession();

        define('sess', $sessionId);

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
