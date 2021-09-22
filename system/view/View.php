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
use System\Http\Response\Response;

/**
 * Класс View
 */
class View extends Template
{
    // Контейнер зависимостей
    protected $container;

    // Тема
    protected $themes;

    // Ответ
    protected $response;

    // Скрыть контент
    public $showed = false;

    // Статус
    public $status = false;

    // Ссылки навигации
    public $nav = false;

    // Доп. css стили
    public $css = false;

    // Данные seo
    public $title, $desc, $keywords = '';

    // Конструктор
    public function __construct(ContainerInterface $container, Themes $themes, Response $response)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Если путь к теме указан верный
        if ($themes->hasPaths()) {
            // Сохранить тему
            $this->themes = $themes;
        }

        $seo = $container->get('config')::pull('system/seo');

        $this->title = $seo['title'];
        $this->desc = $seo['description'];
        $this->keywords = $seo['keywords'];

        $this->response = $response;

        ob_start();
    }

    // Получить путь к шаблонам
    protected function getPath(bool $priority): string
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
    protected function load(string $file, bool $priority = true): string
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

    // Подключить шаблон в шаблоне
    protected function template(string $file): void
    {
        echo $this->load($file);
    }

    protected function layout(string $template, bool $priority): void
    {
        if ($this->status) {
            die('Не возможно повторно использовать шаблон layout');
        }

        $this->status = true;

        // Загрузить шаблон
        $content = $this->load($template, $priority);

        $this->response->body($content);
    }

    // Рендерить шаблон
    public function render(string $template, string $key = '', bool $priority = false): void
    {
        // Если указан layout, сообщить об этом
        if ($template == 'layout') {
            die('Не представляеться возможным. Использование шаблона layout в функции View->render()');
        }

        $path = $this->getPath(true);

        // Загрузить шаблон
        $content = $this->load($template, $priority);

        $this->response->write($content);
    }

    // Вывести на экран все содержимое
    public function put()
    {
        // Если надо скрыть контент
        if ($this->showed) {
            return ;
        }

        // Получить данные пользователя
        $user = $this->container->get('user');
        $config = $this->container->get('config');

        // Параметры для макета
        $layout = (object) [
            'local'     => $config::get('system')['local'],
            'desc'      => $this->desc,
            'keywords'  => $this->keywords,
            'content' => $this->response->getContent(),
            'style'     => [
                cssTime('reset'),
                cssTime('app'),
                cssTime('custom/css/emoji'),
                cssTime('fontello'),
                cssTime('custom/css/icons'),
                cssTime('custom/css/style')
            ]
        ];

        $header = (object) [
            'nav' => $this->nav
        ];

        if ($user->logger) {
            $header->user = [
                'uid' => $user->getUser()['uid'],
                'level' => $user->getUser()['level']
            ];
        }

        // Параметры для всех страниц
        $all = [
            'user_logger' => $user->logger,
            'title' => $this->title
        ];

        if ($user->logger) {
            $all['user'] = [
                'user_uid' => $user->getUser()['uid'],
                'login' => $user->getUser()['login'],
                'level' => $user->getUser()['level']
            ];
        }

        // Установить данные
        $this->set('layout', $layout, 'layout');
        $this->set('header', $header, 'header');
        $this->set('nav', $this->nav, 'nav');
        $this->setAll($all);

        // footer
        $this->set('copy', $config::get('seo')['copy'], 'footer')
            ->set('memory', round((memory_get_usage() - NOMI_MEMORY) / 1024), 'footer')
            ->set('timing', round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4), 'footer');
            //->set('timing', round(microtime(true) - NOMI_START, 4), 'footer');

        // Рендерить макет
        $this->layout('layout', true);
    }

}
