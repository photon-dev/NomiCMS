<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\View;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\View\Template;
use Nomicms\Component\View\TemplateInteface;
use Nomicms\Component\View\Exception\TemplateNotFound;
use Packages\Themes\Component\Themes;
use Nomicms\Component\Http\Response\Response;

/**
 * Класс View
 */
class View extends Template implements TemplateInteface
{
    // Контейнер зависимостей
    protected $container;

    // Тема
    protected $themes;

    // Ответ
    protected $response;

    // Скрыть контент
    public $show = false;

    // Статус
    public $status = false;

    // Ссылки навигации
    public $nav = false;

    // Доп. css стили
    public $css = false;

    // Данные seo
    public $title, $desc, $keywords = '';

    // Конструктор
    public function __construct(ContainerInterface $container, Response $response)
    {
        // Сохранить контейнер
        $this->container = $container;

        $seo = $container->get('config')::pull('seo');

        $this->title = $seo['title'];
        $this->desc = $seo['description'];
        $this->keywords = $seo['keywords'];

        $this->response = $response;

        ob_start();
    }

    // Загрузить шаблон
    protected function load(string $file, bool $priority = true): object
    {
        // Получить путь к шаблону
        $path = $this->container->get('themes')->getPath($priority);

        if (is_dir($path) === false) {
            throw new TemplateNotFound("Папка с шаблонами не найдена, проверьте ее по адресу: {$path}");
        }

        // Если шаблон не найден сообщить об этом
        if (! file_exists($path . $file . '.php')) {
            throw new TemplateNotFound("Шаблон {$file} по пути {$path} не найден");
        }

        return function ($view) use($path, $file) {

            extract($this->get($file));

            ob_start();

            // Подключить шаблон
            require $path . $file . '.php';

            // Показать содержимое
            return ob_get_clean();
        };
    }

    // Подключить шаблон в шаблоне
    protected function template(string $file): void
    {
        $file = $this->load($file);

        echo $file($this);
    }

    protected function layout(string $template, bool $priority): void
    {
        // Загрузить шаблон
        $content = $this->load($template, $priority);

        $this->response->body(
            $content($this)
        );
    }

    // Рендерить шаблон
    public function render(string $template, bool $priority = false): self
    {
        // Если указан layout, сообщить об этом
        if ($template == 'layout') {
            throw new TemplateNotFound("Не представляеться возможным. Использование шаблона 'layout' в методе render");
        }

        // Загрузить шаблон
        $content = $this->load($template, $priority);

        $this->response->write(
            $content($this)
        );

        return $this;
    }

    private function getBackLink()
    {
        $url = $this->container->get('config')::get('route')['url'];

        $list = explode('/', $url);
        $key = count($list) - 1;

        if ($key >= 1 && $list[$key - 1] != 'page') {
            $back = str_replace('/' . $list[$key], '', $url);

            return $back;
        }

        return false;
    }

    // Вывести на экран все содержимое
    public function put()
    {
        // Если надо скрыть контент
        if ($this->show) {
            return ;
        }

        // Получить user, config
        $user = $this->container->get('user');
        $config = $this->container->get('config');

        // Параметры для макета
        $layout = (object) [
            'local'     => $config::get('system')['local'],
            'desc'      => $this->desc,
            'keywords'  => $this->keywords,
            'content'   => $this->response->getContent(),
            'style'     => [
                cssTime('reset'),
                cssTime('app'),
                cssTime('custom/css/emoji'),
                cssTime('fontello'),
                cssTime('custom/css/icons'),
                cssTime('custom/css/css'),
                cssTime('custom/css/style')
            ]
        ];

        // Установить данные для шаблона layout
        $this->set('doc', $layout, 'layout');

        $header = (object) [
            'nav' => $this->nav
        ];

        if ($user->logger) {
            $header->user = [
                'id' => $user->getUser()->id,
                'level' => $user->getUser()->level
            ];
        }

        $footer = (object) [
            'back' => $this->getBackLink(),
            'copy' => $config::get('seo')['copy'],
            'memory' => round((memory_get_usage() - NOMI_MEMORY) / 1024),
            'timing' => round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 4)
        ];

        // Установить данные
        $this->set('header', $header, 'header');
        $this->set('nav', $this->nav, 'nav');
        $this->set('foo', $footer, 'footer');

        $this->setAll([
            'title' => $this->title
        ]);

        // Рендерить макет
        $this->layout('layout', true);
        $this->response->setStatus(200);
    }

}
