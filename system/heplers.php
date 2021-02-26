<?php  declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Использовать
use System\Handler\Handler;
use System\Container\ContainerInterface;

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

// Функция загрузки файлов с настройками
if (!function_exists('config')) {
    function config(string $file, string $path = '')
    {
        if (empty($path)) {
            $path = ROOT;
        }

        if (!file_exists($path . $file . '.php')) {
            die("Файл {$file}.php не найден");
        }

        return require $path . $file . '.php';
    }
}

if (!function_exists('handler'))
{
    function handler(string $error, bool $preend = false)
    {
        // Запустить обработчик
        $err = new Handler;
        $err->set($error);

        // Показать ошибки
        $errors = $err->view($preend);
        $time = cssTime('app.min');

        require_once PACKS . 'main/view/error.php';
        die;
    }
}

if (!function_exists('error'))
{
    function error(string $error)
    {
        $time = cssTime('app.min');

        require_once PACKS . 'main/view/error.php';
        die;
    }
}

if (!function_exists('cssTime'))
{
    function cssTime(string $css)
    {
        $path = WEBSITE . 'themes/' . $css . '.css';

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
        $view->showed = true;

        // Перейти
        header('location: ' . $url);
        die;
    }
}
