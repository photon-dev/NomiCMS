<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\App;

// Использовать
use System\Container\ContainerInterface;
use System\App\AppInterface;
use System\Http\Response\ResponseInterface;
use System\View\Template;

/**
 * Класс AppFactory
 */
class AppFactory
{
    // Если проложение уже запущено
    protected static $app;

    // Создать фабрику
    public static function create(AppInterface $app, ContainerInterface $container)
    {
        // Если приложение запущено выдать предупреждение
        if (AppFactory::$app !== null) {
            die('Приложение уже запущено');
            return ;
        }

        // Установить приложение
        AppFactory::$app = $app;

        // Собрать все содержимое, и отправить
        return function () use ($app, $container): ResponseInterface {

            // Получить response
            $response = $container->get('response');

            //header('Expires: ' . date('r'), true);

            //$response->setHeader('Cache-Control',  'no-store, no-cache, must-revalidate');

            $view = $container->get('view');

            $view->set([
                'text' => 'Photon'
            ], 'index');

            $view->set([
                'copy' => 'Nomicms'
            ], 'footer');

            // Запустить
            $view->put();

            dd($view->some);
            dd($view->everyone);

            // Установить заголовки
            //$response->setHeaders();
            //header('Cache-Control: no-store, no-cache, must-revalidate', true);
            //header('Expires: ' . date('r'), true);
            //header('Content-Type: text/html; charset=utf-8', true);

            // Получить view
            //$view = $container->get('view');

            /*
            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Запустить шаблонизатор
            //$view = $container->get('view.view');

            // Загрузить файл источник
            require PACKS . $app->getPathSource();

            $response = $view->put();

            //dd($response);
            */
            // Отправить ответ
            return $response;
        };
    }
}
