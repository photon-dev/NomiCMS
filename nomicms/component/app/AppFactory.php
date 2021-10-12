<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\App;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\App\AppInterface;
use Nomicms\Component\Http\Response\ResponseInterface;
use Nomicms\Component\View\Template;

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

            // Получить response, user, view
            $response = $container->get('response');
            $view = $container->get('view');
            $user = $container->get('user');

            // Установить headers
            header('Cache-Control: no-store, no-cache, must-revalidate', true);
            header('Expires: ' . date('r'), true);
            header('Content-Type: text/html; charset=utf-8', true);

            // Получить, извлечь параметры
            if ($app->getParams()) {
                extract($app->getParams());
            }

            // Загрузить файл источник
            require PACKAGES . $app->getPathSource();

            // Если выключено скрытите
            if (! $view->show) {
                // Вывести на экран все содержимое
                $view->put();
            }

            // Отправить ответ
            return $response;
        };
    }
}
