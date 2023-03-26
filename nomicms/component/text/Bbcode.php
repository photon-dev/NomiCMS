<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Text;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\View\TemplateInteface;

/**
 * Класс Bbcode
 */
class Bbcode
{
    // Паттерны
    protected static $pattern = [
        // Html
        '/\[b\](.*?)\[\/b\]/s',
        '/\[i\](.*?)\[\/i\]/s',
        '/\[u\](.*?)\[\/u\]/s',
        '/\[s\](.*?)\[\/s\]/s',
        '/\[code\](.*?)\[\/code\]/s',

        // Елементы из css
        '/\[cit\](.*?)\[\/cit\]/s',
        '/\[rep\](.*?)\[\/rep\]/s',

        // Цветовые коды
        '/\[red\](.*?)\[\/red\]/s',
        '/\[green\](.*?)\[\/green\]/s',
        '/\[blue\](.*?)\[\/blue\]/s',
        '/\[yellow\](.*?)\[\/yellow\]/s',
        '/\[color\=(.*?)\](.*?)\[\/color\]/s',
        '/\[bg\=(\w+)\](.*?)\[\/bg\]/s',

        // Ссылки
        '/(^|\s|-|:| |\()(http:\/\/|https:\/\/)?(www)?([\da-z\.-]+)\.([a-z\.]{2,6})*\/?/s',
        '/\[url\](.*?)\[\/url\]/s',
        '/\[url\=(.*?)\](.*?)\[\/url\]/s',

        // Изображение, Аудио, Видео
        '/\[img\](.*?)\[\/img\]/s',
        '/\[audio\](.*?)\.(.*?)\[\/audio\]/s',
        '/\[video\](.*?)\.(.*?)\[\/video\]/s',
        '/\[youtube\](.*youtu(?:\.be\/|be\.com\/.*(?:vi?\/?=?|embed\/)))(.*?)\[\/youtube\]/s'
    ];

    // Замены паттерам
    protected static $replace = [
        // Html
        '<b>$1</b>',
        '<i>$1</i>',
        '<u>$1</u>',
        '<s>$1</s>',
        '<code>$1</code>',

        // Елементы из css
        '<div class="cit">$1</div>',
        '<div class="rep">$1</div>',

        // Цветовые коды
        '<span style="color: #f44336">$1</span>',
        '<span style="color: #81c136">$1</span>',
        '<span style="color: #2196f3">$1</span>',
        '<span style="color: #f4f121">$1</span>',
        '<span style="color: $1">$2</span>',
        '<span style="background-color: $1">$2</span>',

        // Ссылки
        ' <a class="link_visual" href="http://$4.$5" title="Перейти на $4.$5" target="_blank">$4.$5</a>',
        '<a class="link_visual" href="$1" title="Перейти по ссылке" target="_blank">$1</a>',
        '<a class="link_visual" href="$1" title="Перейти на $2" target="_blank">$2</a>',

        // Изображение, Аудио, Видео
        '<a href="$1" title="Перейти к изображению"><img class="attach" src="$1" alt="Image"></a>',
        '<audio controls><source src="$1.$2" type="audio/$2"></audio>',
        '<video class="video" controls><source src="$1.$2" type="video/$2"></video>',
        '<iframe class="youtube" src="https://www.youtube.com/embed/$2" frameborder="0" allowfullscreen></iframe>'
    ];

    public static function parse(string $text)
    {
        $text = preg_replace(self::$pattern, self::$replace, $text);

        return $text;
    }

    public static function code(array $match)
    {
        return '<code class="prettyprint linenums pre-scrollable">' . $match[1] . '</pre>';
    }

    public static function view(TemplateInteface $view)
    {
        $view->render();
    }
}
