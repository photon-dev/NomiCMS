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

// Форматирует вывод массивов и обьектов в строку
// Создано на момент разработки и тестирования
if (!function_exists('dd')) {
    function dd($dd)
    {
        return var_dump($dd);
    }
}

// Функция загрузки файлов с настройками
if (!function_exists('loadFile')) {
    function loadFile(string $file)
    {
        $path = ROOT . $file . '.php';

        if (!file_exists($path)) {
            die("Файл {$file}.php не найден");
        }

        return require $path;
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

if (!function_exists('checkEnv')) {
    function checkEnv(string $env)
    {
        if ($env == 'dev' || $env == 'product') {
            return true;
        }

        return false;
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
    function go_die(string $url = '/', $exit = true)
    {
        //ob_start();

        header('location: ' . $url);

        if ($exit) {
            die;
        }
    }
}
