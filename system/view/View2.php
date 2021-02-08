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
class View //extends Template
{
    // Контейнер зависимостей
    protected $container;

    // Хранилище
    protected $themes;

    // Загружен
    public $run = false;

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

    // Получить путь к шаблонам пакета
    protected function getPathPackage(): string
    {
        $route = $this->container->get('config')::get('route');

        return PACKS . $route['package']  . '/view/';
    }

    // Загрузить шаблон
    protected function loadFile(string $file, bool $load)
    {
        // Установить путь от куда грузить шаблон
        $path = $load ? $this->themes->getPath() : $this->getPathPackage();

        if (is_dir($path) === false) {
            throw new TemplateNotFound("Папка с шаблонами не найдена, проверьте ее по адресу: {$path}");
        }

        // Если шаблон не найден сообщить об этом
        if (file_exists($path . $file . '.php') === false) {
            throw new TemplateNotFound("Шаблон {$file} не найден");
        }

        ob_start();

        //$render = render();
        //$render(self::get(), $path . $file . '.php');
        // Извлечь данные
        /*dd($this::get($file));*/
        extract($this::get($file));

        // Подключить шаблон
        include $path . $file . '.php';

        // Очистим дату для экономии используемых данных
        //self::сlear();

        return ob_get_clean();
    }

    // Показать шаблон
    public function render(string $file, bool $load = false, bool $preend = false): void
    {
        $response = $this->container->get('response');

        // Загрузить файл
        $content = $this->loadFile($file, $load);

        if ($preend) {
            $response->body($content);
        } else {
            $response->write($content);
        }
        //$response->
    }

    // Вывести на экран все содержимое
    //public function __destruct()
    public function put(): ResponseInterface
    {
        // Получить зависимость response
        $response = $this->container->get('response');

        if ($this->showed) {
            return $response->clear();
            //return ;
        }

        // Загрузить настройки seo
        $seo = $this->container->get('config')::pull('system/seo');

        $basic = [
            'response' => (object) [
                'local_html'    => $seo['local_html'],
                'title'         => $this->title ? $seo['title'] . ' - ' .$this->title : $seo['title'],
                'description'   => $this->description ?? $seo['description'],
                'keywords'      => $this->keywords ?? $seo['keywords'],
                'content'       => $response->getContent(),
                'memory'        => round((memory_get_usage() - NOMI_MEMORY) / 1024),
                'timing'        => round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 6)
            ]
        ];

        // Сохранить настройки
        $this::add($basic, 'basic');

        $this->render('basic', true, true);

        return $response;
    }

}
