<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\App;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\App\AppConfigure;
use Nomicms\Component\App\AppInterface;
use Nomicms\Component\App\AppFactory;

/**
 * Класс NomiApp
 */
class NomiApp extends AppConfigure implements AppInterface
{
    // Контейнер
    protected $container;

    // Пакет
    public $package = '';

    // Системные настройки
    protected $system = [];

    // Настройки пакета
    public $settings = [];

    // Язык
    public $local = 'ru';

    // Пунктов на страницу
    public $post_page = 7;

    // Запущен
    protected $status = false;

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Загрузить настройки системы
        $this->system = $container->get('config')::get('system');

        // Сохранить контейнер
        $this->container = $container;

        // Настроить приложение
        parent::__construct();
    }

    // Заперт на повторную загрузка приложения
    protected function die()
    {
        if ($this->status) {
            die('Повторная настройка приложение не доступна');
            return;
        }
    }

    // Настроить приложение
    public function configure()
    {
        // Запертить на повторную настройку
        $this->die();

        // Получить пользователя
        $user = $this->container->get('user');

        // Установить язык
        $this->local = $user->logger ? $user->getUser()->local : $this->system['local'];

        // Установить количество пунктов
        $this->post_page = $user->logger ? $user->getUser()->post_page : $this->system['post_page'];

        // Установить пакет
        if ($this->found) {
            $this->package = $this->route['package'];
        }

        /**
         * В данной месте будут выполняться все возможные Event (Эвенты)
         *
         * Event - Это рассылка писем, счетчик онлайна, работа с аунтификацией, и т.п.
         * В данный момент пропущщу
         */
    }

    // Запустить приложение
    public function run()
    {
        // Запертить на повторный запуск
        $this->die();

        if (! $this->found) {
            $this->notFound('Страница не найдена');
        }

        // Если папка с пакетом не найдена
        if (! $this->hasPackage()) {
            die("Пакет: <b>{$this->route['package']}</b> не найден");
            return ;
        }

        // Если исходный файл не найден
        if (! $this->hasSource()) {
            die("Файл: <b>{$this->route['src']}</b> не найден.<br /> Пакет: <b>{$this->route['package']}</b>");
            return ;
        }

        // Установить статус
        $this->status = true;

        // Создать фабрику
        $factory = AppFactory::create($this, $this->container);
        $response = $factory();

        // Отправить все содержимое
        return $response->send();
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


    public function getStatus()
    {
        return 'beta';
    }
}
