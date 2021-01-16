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
use Packages\Themes\Themes;

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

    // Имя страницы
    public $title = false;

    // Описание страницы
    public $desc = false;

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

        $this->themes = $themes;
    }

    protected function loadFile(string $file, bool $preend = false)
    {
        $path = $this->path . $fileName . $this->fileType;

        if (!file_exists($path)) {
            throw new TemplateNotFound("Шаблон {$file} не найден");
        }

    }

    // Показать шаблон
    public function view(string $file, bool $response = false)
    {
        if ($response) {

        }
        //$fileName;
        //dd($fileName);
        return '';
    }

    // При завершении скрипта показать ответ клиенту
    public function __destruct()//: Response
    {
        $this->view('basic', true);

        return $this->response->send();
    }

}
