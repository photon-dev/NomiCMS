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

    // Системные данные
    public $memory, $timing = 0;

    // Конструктор
    public function __construct(ContainerInterface $container, Themes $themes)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Сохранить тему
        $this->themes = $themes;
    }

    // Получить путь к шаблонам
    protected function getPath(bool $priority)
    {
        if ($priority) {
            return $this->themes->getPath();
        }

        $route = $this->container->get('config')::get('route');

        return PACKS . $route['package']  . '/view/';
    }

    // Загрузить шаблон
    protected function load(string $file, bool $priority)
    {
        // Получить путь к шаблону
        //$path = $this->getPath($priority);
        $path = SYS . 'view/test/';

        if (is_dir($path) === false) {
            throw new TemplateNotFound("Папка с шаблонами не найдена, проверьте ее по адресу: {$path}");
        }

        // Если шаблон не найден сообщить об этом
        if (file_exists($path . $file . '.php') === false) {
            throw new TemplateNotFound("Шаблон {$file} не найден");
        }

        extract($this::get($file));

        ob_start();

        include $path . $file . '.php';

        return ob_get_clean();
    }

    // Render
    public function render(string $template, bool $priority = false): void
    {
        $response = $this->container->get('response');

        // Загрузить файл
        $content = $this->load($template, $priority);

        echo $content;
        //$response->body($content);
    }

    // Вывести на экран все содержимое
    //public function __destruct()
    public function put()
    {
        // Получить зависимость response
        $response = $this->container->get('response');

        // Загрузить настройки seo
        $seo = $this->container->get('config')::pull('system/seo');

        // Установить заголовок страницы
        $title = [
            'title' => $this->title ?? $seo['title']
        ];

        $basic = [
            'response' => (object) [
                'local_html'    => $seo['local_html'],
                'title'         => $this->title ?? $seo['title'],
                'description'   => $this->description ?? $seo['description'],
                'keywords'      => $this->keywords ?? $seo['keywords'],
                //'content'       => $response->getContent(),
                'memory'        => round((memory_get_usage() - NOMI_MEMORY) / 1024),
                'timing'        => round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 6)
            ]
        ];

        $this->setAll($title);
        $this->set($basic, 'layout');
        //$this->render('header');
        //$this->render('footer');

        $this->render('layout', true);

        return '';
    }

}
