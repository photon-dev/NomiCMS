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
//use System\View\Exception\TemplateNotFound;
//use Packages\Themes\Component\Themes;
//use System\Http\Response\Response;

/**
 * Класс Views
 */
class Views extends Templates
{
    // Шаблон
    protected $template = '';

    // Расширение файлов
    protected $ext = '.php';

    // Путь
    public $path = '';

    // Констру{ктор
    public function __construct(string $template = '')
    {
        // Установить шаблон
        $this->template = $template;
    }

    public function compile(string $template)
    {

    }

    public function render(bool $priority = false)
    {
        $data = parent::render($priority);

        //dd($data);

        return $priority;
    }
}
