<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\View;

// Использовать
use System\Container\ContainerInterface;
use System\View\Template;
use System\View\Exception\TemplateNotFound;
use Packages\Themes\Component\Themes;
use System\Http\ResponseInterface;

/**
 * Класс View
 */
class View extends Template
{
    // Контейнер зависимостей
    protected $container;

    // Хранилище
    protected $themes;

    // Скрыть контент
    public $showed = false;

    // Статус
    public $status = false;

    // Конструктор
    public function __construct(ContainerInterface $container, Themes $themes)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Если путь к теме указан верный
        if ($themes->hasPaths()) {
            // Сохранить тему
            $this->themes = $themes;
        }

        ob_start();
    }

    // Получить путь к шаблонам
    protected function getPath(bool $priority)
    {
        // Приоритет загрузки
        if ($priority) {
            // Показать
            return $this->themes->getPath();
        }

        // Получить имя пакета
        $package = $this->container->get('config')::get('route')['package'];

        // Показать
        return PACKS . $package  . '/view/';
    }

    // Загрузить шаблон
    protected function load(string $file, bool $priority = true)
    {
        // Получить путь к шаблону
        $path = $this->getPath($priority);

        if (is_dir($path) === false) {
            throw new TemplateNotFound("Папка с шаблонами не найдена, проверьте ее по адресу: {$path}");
        }

        // Если шаблон не найден сообщить об этом
        if (file_exists($path . $file . '.php') === false) {
            throw new TemplateNotFound("Шаблон {$file} $path не найден");
        }

        // Извлечь переменные
        extract($this->get($file));

        ob_start();

        // Подключить шаблон
        require $path . $file . '.php';

        // Показать содержимое
        return ob_get_clean();
    }

    // Подключить шаблон прям в шаблон
    protected function template(string $file): void
    {
        echo $this->load($file);
    }

    public function navbar()
    {
        $route = $this->container->get('config')::get('route');
        $data = explode('/', $route['url']);

        $this->set('nav', [
            'route' => $data
        ]);

        $name = $this->container->get('config')::load($route['package'] . '/config/package', PACKAGE)['name'];
        //$settings = $this->container->get('config')::get($route['package']);
        dd('sdsdsds');
        dd($settings);
    }

    // Рендерить шаблон
    public function render(string $template, bool $priority = false, bool $write = false): void
    {
        // Если статус true ничего не показывать
        if ($this->status) {
            return ;
        }

        // Если указан layout тогда считать что шаблонизатор запущен
        // Костыль от повторного подключения шаблона layout.php
        if ($template == 'layout') {
            $this->status = true;
        }

        // Подключить response
        $response = $this->container->get('response');

        // Загрузить шаблон
        $content = $this->load($template, $priority);

        // Сохранить в тело ответа
        if ($write) {
            $response->body($content);
        // Либо в контент
        } else {
            $response->write($content);
        }
    }

    // Вывести на экран все содержимое
    public function put(): void
    {
        // Если надо скрыть контент
        if ($this->showed) {
            return ;
        }

        // Получить зависимости
        $response = $this->container->get('response');
        $config = $this->container->get('config');
        $db = $this->container->get('db');
        $user = $this->container->get('user');

        // Загрузить настройки
        $system = $config::get('system');
        $seo = $config::pull('system/seo');

        // Параметры для макета
        $layout = (object) [
            'local'     => $user->logger ? $user->getUser()['local'] : $system['local'],
            'desc'      => $this->description ?? $seo['description'],
            'keywords'  => $this->keywords ?? $seo['keywords'],
            'content' => $response->getContent(),
            'style'     => [
                cssTime('reset'),
                cssTime('app'),
                cssTime('custom/css/emoji'),
                cssTime('custom/css/fontello'),
                cssTime('custom/css/icons'),
                cssTime('custom/css/style')
            ]
        ];

        $header = (object) [
            'nav' => $this->nav ?? false
        ];

        if ($user->logger) {
            $header->user = [
                'uid' => $user->getUser()['uid'],
                'login' => $user->getUser()['login'],
                'level' => $user->getUser()['level']
            ];
        }

        $count = $db->query('SELECT
        (SELECT COUNT(*) FROM news) AS news,
        (SELECT COUNT(*) FROM news WHERE date_write > "' . (TIME - DAY) . '") AS new_news,
        (SELECT COUNT(*) FROM chat) AS chat_message,
        (SELECT COUNT(*) FROM chat WHERE date_write > "' . (TIME - DAY) . '") AS new_chat_message,
        (SELECT COUNT(*) FROM user) AS users,
        (SELECT COUNT(*) FROM user WHERE date_signup > "' . (TIME - DAY) . '") AS new_users
        FROM dual')->fetch_assoc();

        $this->set('sidebar', ['count' => (object) $count]);

        // Параметры footer
        $footer = [
            'memory' => round((memory_get_usage() - NOMI_MEMORY) / 1024),
            'timing' => round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4)
        ];

        // Параметры для всех страниц
        $all = [
            'user_logger' => $user->logger,
            'title' => $this->title ?? $seo['title']
        ];

        if ($user->logger) {
            $all['user'] = [
                'uid' => $user->getUser()['uid'],
                'login' => $user->getUser()['login']
            ];
        }

        // Установить данные
        $this->set('layout', $layout);
        $this->set('header', $header);
        $this->set('footer', $footer);
        $this->setAll($all);

        // Рендерить макет
        $this->render('layout', true, true);
    }

}
