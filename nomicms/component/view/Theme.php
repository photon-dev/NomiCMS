<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\View;


/**
 * Класс Html
 */
class Theme //extends AnotherClass
{
    // Мета теги
    public $meta = [];

    // Стили
    public $css = [];

    // Java скрипты
    public $js = [];

    public function __construct(){}

    // Очистить
    public function clear()
    {
        $this->meta = [];
        $this->css  = [];
        $this->js   = [];
    }

    public static function encode($content, $encode = true)
    {
        return htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', $encode);
    }

    public static function decode($content)
    {
        return htmlspecialchars_decode($content, ENT_QUOTES);
    }
}
