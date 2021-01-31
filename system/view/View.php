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

    // Скрыть контент
    public $showed = false;

    // Имя страницы
    public $title = false;

    // Описание страницы
    public $description = false;

    // Ключевые слова
    public $keywords = false;

    // Память и синхронизация
    public $memory, $timing = 0;

    // Авто-загрузчик
    public $autoload = [
        'counter' => 0,
        'timing' => 0
    ];

    // Конструктор
    public function __construct(array $config = [], ContainerInterface $container, Themes $themes)
    {
        // Установить контейнер
        $this->container = $container;

        // Установить тему
        $this->themes = $themes;

    }

    protected function getPath()
    {
        return $this->themes->getPath()  . 'template/';
    }

    protected function loadFile(string $file)
    {
        $path = $this->getPath() . $file . '.php';

        if (!file_exists($path)) {
            throw new TemplateNotFound("Шаблон {$file} не найден");
        }

        extract(self::get());

        ob_start();
        require $path;

        // Очистим дату для экономии используемых данных
        self::сlear();

        return ob_get_clean();
    }

    // Показать шаблон
    public function view(string $file, bool $preend = false): void
    {
        $response = $this->container->get('http.response');

        $content = $this->loadFile($file);

        if ($file == 'basic') {
            //dd($content);
        }

        if ($preend) {
            $response->body($content);
        } else {
            $response->write($content);
        }
    }

    // При завершении скрипта показать ответ клиенту
    public function output()
    {
        // Получить зависимость response
        $response = $this->container->get('http.response');

        if ($this->showed) {
            return  $response->clear();
        }

        // Загрузить настройки
        $seo = $this->container->get('config.config')::pull('system/seo');

        self::setObject('title', function ()
        {
            if ($this->title) {
                return $seo['title'];
            }
            //$config['title'];
        });

        $doc = (object) [
            'local_html'    => $seo['local_html'],
            'title'         => $this->title ? $this->title : $seo['title'],
            'description'   => $this->description ? $this->description : $seo['description'],
            'keywords'      => $this->keywords ?? $seo['keywords'],
            'content'       => $response->getContent(),
            'memory'        => $this->memory,
            'timing'        => $this->timing,
            'autoload'      => $this->autoload
        ];

        self::setObject('response', $doc);

        $this->view('basic', true);

        return $response;
    }

}
