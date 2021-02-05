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
use System\Response\ResponseInterface;

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

    // Запущен
    protected $status = false;

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

    }

    // Запустить маршрутизатор
    protected function router(): void
    {
        // Загрузить доступные маршруты
        $routes = loadFile('config/routes');

        // Обработать их
        $routes = $routes($this->container);

        // Запустить маршрутизатор
        $router = $this->container->get('router.router', [
            'routes' => $routes
        ]);

        // Если маршрут найден
        if ($router->getFound()) {
            // Получить маршрут
            $this->route = $router->getRoute();

            // Сохранить маршрут
            $this->container->get('config.config')::add('route', $this->route);

            // Установить как запущено
            $this->found = true;

        }
    }

    // Заперт на повторную загрузка приложения
    protected function die()
    {
        if ($this->status) {
            die('Повторная настройка приложение не доступна');
            return;
        }
    }

    // Получить информацию о текущем маршруте
    public function getRoute(): array
    {
        return $this->route;
    }

    // Настроить приложение
    public function configure()
    {
        // Запертить на повторную настройку
        $this->die();

        // Запустить маршрутизатор
        $this->router();

        /**
         * В данной месте будут выполняться все возможные Event (Эвенты)
         *
         * Event - Это рассылка писем, счетчик онлайна, работа с аунтификацией, и т.п.
         * В данный момент пропущщу
         */
    }

    // Запустить приложение
    public function run($autoload)
    {
        // Запертить на повторный запуск
        $this->die();

        if (! $this->found) {
            $this->notFound('Страница не найдена');
        }

        // Если папка с пакетом не найдена
        if (! $this->hasPackage()) {
            die("Пакет <b>{$this->route['package']}</b> не найден");
            return;
        }

        // Если исходный файл не найден
        if (! $this->hasPackage()) {
            die("Исходный файл <b>{$this->route['src']}</b> не найден");
            return;
        }
        // Установить статус
        $this->status = true;

        // Создать фабрику
        $factory = Factory::create($this, $this->container);

        // Отправить все содержимое
        return $factory($autoload);
    }

    // Показать ошибку
    protected function notFound($error)
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
