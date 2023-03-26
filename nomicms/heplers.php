<?php  declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use Nomicms\Component\Container\ContainerInterface;

// Форматирует вывод массивов и обьектов в строку
// Создано на момент разработки и тестирования
if (!function_exists('dd')) {
    function dd($dd)
    {
        echo "<pre>";
        var_dump($dd);
        echo "</pre>";
        return '';
    }
}

// Функция загрузки файлов
if (!function_exists('load')) {
    function load(string $file, string $path)
    {
        if (! file_exists($path . $file . '.php')) {
            error("Файл {$file}.php не найден");
        }

        return require $path . $file . '.php';
    }
}

// Функция подключения app-файлов
if (! function_exists('app')) {
    function app(string $app) {
        return load($app, APP);
    }
}

// Функция загрузки пакет-файлов
if (!function_exists('package')) {
    function package(string $package) {

        return load($package, PACKAGES);
    }
}

// Функция загрузки файлов с настройкамиг
if (!function_exists('config')) {
    function config(string $file, string $path = '')
    {
        if (empty($path)) {
            $path = CONFIG;
        }

        return load($file, $path);
    }
}

// Функция вывода ощибки на экран
if (!function_exists('error'))
{
    function error(string $error)
    {
        $time = cssTime('apps');

        require_once PACKAGES . 'main/view/error.php';
        die;
    }
}

// Получить время создание css файла
if (!function_exists('cssTime'))
{
    function cssTime(string $css)
    {
        $path = THEMES . $css . '.css';

        if (! file_exists($path)) {
            return '';
        }

        return filemtime($path);
    }
}

// Переход через заголовок
if (!function_exists('go_die')) {
    function go_die(ContainerInterface $container, string $url = '/')
    {
        // Получить шаблонизатор
        $view = $container->get('view');
        // Скрыть контент
        $view->show = true;

        // Перейти
        header('location: ' . $url);
        die;
    }
}

// Получить обратную ссылку
if (! function_exists('getHomeBack')) {
    function getHomeBack(string $url): bool
    {
        return ($url == '/') ? false : true;
    }
}

if (! function_exists('smile')) {
    function smile($text = '') {
        $smiles = config('smiles');

    	$smiles = array_unique($smiles, SORT_REGULAR);
    	foreach ($smiles as $a) {
            echo '<a onclick="tag(\':'.$a.':\')"><i class="emoji-'. $a .'"></i></a>';
        }

        return true;
    }
}
