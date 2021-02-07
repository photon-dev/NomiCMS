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
use System\Http\ResponseInterface;

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

            // Получить request
            $request = $container->get('request');

            // Если сообщение и код введены
            if ($request->post->has('message') && $request->post->has('S_Code')) {

                $message = $request->post->message;
                $code = $request->post->S_Code;

                if (empty($message)) echo '<p style="color: #f44336">Введите сообщение</p>';
                if ($code == '11cccac23743195c813de8ec0cf6cb49') echo '<p style="color: #f44336">Проверочный код введен не верно</p>';

                if (!empty($message)) {

                    echo '<b>Ваше сообщение:</b> <p style="color: #4CAF50">' . $message . '</p>';
                }
            } else {
                echo '<p style="color: #2980B9">Хотите написать в чат?</p>';
            }

            echo '<hr><br />
            <form method="POST" name="message" action="">
                Сообщение:<br>
                <textarea name="message"></textarea><br>
                <input type="hidden" name="S_Code" value="11cccac23743195c813de8ec0cf6cb49">
                <button>Отправить</button>
            </form>
            ';




























            //setcookie('login', 'Photon', time()+60+60*24*365);

            //dd($cookie->login);

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
