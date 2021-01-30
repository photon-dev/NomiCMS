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
use System\Response\Response;
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

    // Ответ клиенту
    public $response;

    // Хранилище
    protected $themes;

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
    public function __construct(ContainerInterface $container, Response $response, Themes $themes)
    {
        // Установить контейнер
        $this->container = $container;

        // Установить ответ клиенту
        $this->response = $response;

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
    public function output(string $file, bool $response = false): void
    {
        $content = $this->loadFile($file);

        if ($response) {
            $this->response->body($content);
        } else {
            $this->response->write($content);
        }
    }

    // При завершении скрипта показать ответ клиенту
    public function __destruct()//: Response
    {
        if ($this->showed) {

            return  $this->response->clear();
        }
        // Загрузить настройки
        $config = $this->container->get('config.config')::pull('system/seo');

        self::setObject('title', function ()
        {
            if ($this->title) {
                return $config['title'];
            }
            //$config['title'];
        });

        $doc = (object) [
            'local_html'    => $config['title'],
            'title'         => $this->title ? $this->title : $config['title'],
            'description'   => $this->description ? $this->description : $config['description'],
            'keywords'      => $this->keywords ?? $config['keywords'],
            'content'       => $this->response->getContent(),
            'memory'        => $this->memory,
            'timing'        => $this->timing,
            'autoload'      => $this->autoload
        ];

        self::setObject('response', $doc);

        //dd(self::get());

        $this->output('basic', true);

        return $this->response->send();
    }

}
