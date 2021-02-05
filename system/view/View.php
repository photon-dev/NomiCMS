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
use System\Http\Response;
use System\Http\ResponseInterface;
use System\View\Template;
use System\View\Exception\TemplateNotFound;
use Packages\Themes\Component\Themes;

/**
 * Класс View
 */
class View extends Template
{
    // Контейнер зависимостей
    protected $container;

    // Хранилище
    protected $themes;

    // Загружен
    public $run = false;

    // Скрыть контент
    public $showed = false;

    // Имя страницы
    public $title = false;

    // Описание страницы
    public $description = false;

    // Ключевые слова
    public $keywords = false;

    //
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
    protected function load(string $file, bool $load)
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

        // Если данные найдены, показать их
        extract(self::get());

        ob_start();

        // Подключить шаблон
        require $path . $file . '.php';

        // Очистим дату для экономии используемых данных
        self::сlear();

        return ob_get_clean();
    }

    // Показать шаблон
    public function view(string $file, bool $load = false, bool $preend = false): void
    {
        $response = $this->container->get('response');

        $content = $this->load($file, $load);

        if ($preend) {
            $response->body($content);
        } else {
            $response->write($content);
        }
    }

    // Вывести на экран все содержимое
    public function __destruct()
    {
        // Получить зависимость response
        $response = $this->container->get('response');

        if ($this->showed) {
            return $response->clear();
        }

        // Загрузить настройки seo
        $seo = $this->container->get('config')::pull('system/seo');

        $basic = (object) [
            'local_html'    => $seo['local_html'],
            'title'         => $this->title ? $this->title : $seo['title'],
            'description'   => $this->description ? $this->description : $seo['description'],
            'keywords'      => $this->keywords ?? $seo['keywords'],
            'content'       => $response->getContent(),
            'memory'        => $this->memory,
            'timing'        => $this->timing
        ];

        // Сохранить настройки
        self::setObject('response', $basic);

        $this->view('basic', true, true);

        return $response->send();
    }

}
