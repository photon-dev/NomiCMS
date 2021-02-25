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

            // Получить шаблонизатор
            $view = $container->get('view');

            // Получить пользователя
            $user = $container->get('user');

            // Установить заголовки
            header('Cache-Control: no-store, no-cache, must-revalidate', true);
            header('Expires: ' . date('r'), true);
            header('Content-Type: text/html; charset=utf-8', true);

            // Если есть GET данные то распаковать их
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Загрузить файл источник
            require PACKS . $app->getPathSource();

            // Если выключено скрытите
            if (! $view->showed) {
                // Вывести на экран все содержимое
                $view->put();
            }

            // Отправить ответ
            return $response;
        };
    }
}
