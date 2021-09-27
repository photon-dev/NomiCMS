<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Text;

// Использовать
use System\Container\ContainerInterface;
use System\View\TemplateInteface;

/**
 * Класс Emoji
 */
class Emoji
{
    // Паттерны
    protected static $pattern = [
        // Html
        '/:((\w+)):/s',
        //'/:((\w+))/s',
        '/(:\)|:-\)|=\))/s', // Улыбка
        '/(:\(|:-\(|=\()/s', // Грусть
        '/(:d|:-d|=d|:D|:-D|=D)/s', // Большая ухмылка
        '/(:p|:-p|=p|:P|:-P|=P)/s'
    ];


    // Замены паттерам
    protected static $replace = [
        '<i class="emoji-$1"></i>',
        //'<i class="emoji-$1"></i>',
        '<i class="emoji-smile"></i>',
        '<i class="emoji-sad"></i>',
        '<i class="emoji-biggrin"></i>',
        '<i class="emoji-tab"></i>'
    ];

    public static function emo(string $text)
    {
        $text = preg_replace(self::$pattern, self::$replace, $text);

        return $text;
    }
}
