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
    protected function load(string $filename, bool $priority)
    {
        // Получить путь к шаблону
        $path = $this->getPath();
    }

    // Render
    public function render(string $template, bool $priority = false): void
    {
        //$data = ;

        $this->map[$template] = $priority;
        //dd($name);
    }

    // Вывести на экран все содержимое
    //public function __destruct()
    public function put()
    {

        $this->render('header');
        $this->render('footer');
        $this->render('layout');

        return '';
    }

}
