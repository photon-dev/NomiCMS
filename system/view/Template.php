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
class Template //extends Template
{
    // Буфер
    protected $buffer = 0;

    // Контент
    protected $content;

    // Карта
    public $map = [];

    public function resolve(string $name)
    {
        if (isset($this->map[$name])) {
            return $this->map[$name];
        }
    }

}
