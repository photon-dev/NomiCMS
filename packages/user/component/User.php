<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\User\Component;

// Использовать
use System\Container\ContainerInterface;
use System\Text\Misc;

/**
 * Класс User
 */
class User
{
    // Контейнер
    protected $container;

    // Данные пользователя
    protected $user = [];

    // Авторизован
    public $logger = false;

    // Проверка на бан
    public $banned = false;

    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Если пользователь не авторизован
        if (! $this->logger) {
            // Войти в систему
            $this->logger = $this->logon();
        }
    }

    protected function logon()
    {
        if ($this->logger) {
            return ;
        }

        // Подключить сессии, cookie
        $session = $this->container->get('session');
        $cookie = $this->container->get('cookie');

        //$sessionLogin = $session->user['login'] ?? false;

        // Если активна сессия
        if ($session->user) {

            // Сохранить пользователя
            $this->user = $session->user;

            return true;
        }

        // Если у в куках есть данные о пользователе
        if ($cookie->login && $cookie->password) {
            // Подключить базу данных
            $db = $this->container->get('db');

            // Обработать логин  и пароль
            $login =  Misc::str($cookie->login, $db);
            $password = Misc::str($cookie->password, $db);

            // Текс запроса в базу данных
            $query = 'SELECT u.uid, u.login, u.level, us.shift_time, us.local, us.theme, us.post_page
            FROM user AS u
            LEFT JOIN user_settings AS us ON us.user_uid = u.uid
            WHERE login = "' . $login . '" AND password = "' . $password . '" LIMIT 1';

            // Выполнить запрос в базу данных
            $user = $db->query($query)->fetch_assoc();

            // Записать данные в сессию
            $session->user($user);

            // Сохранить пользователя
            $this->user = $user;

            return true;
        }
        
        //$cookie->login('Photon', ['expires' => TIME + YEAR]);
        //$cookie->password('$2y$10$AhPC/.083r11/N8x.66C7ujprrfrG4hDcozwciSvHYGV8UCc0B44G', ['expires' => TIME + YEAR]);

        //dd($sessionLogin);

        return false;
    }

    // Получить данные пользователя
    public function getUser(): array
    {
        if ($this->logger && isset($this->user['uid'])) {
            return $this->user;
        }

        return [];
    }

}
