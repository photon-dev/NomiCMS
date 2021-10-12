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
use System\View\View;

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

    // Бан
    public $banned = false;

    public function __construct(ContainerInterface $container, View $view)
    {
        // Установить контейнер
        $this->container = $container;

        // Не авторизован
        if (! $this->logger) {
            // Войти в систему
            $this->logger = $this->logon();
        }

        // Установить для всех шаблонов
        $view->setAll((object) $this->set(), 'user');
    }

    // Установить данные для всех шаблонов
    protected function set(): array
    {
        // Авторизован
        if ($this->logger) {
            return [
                'logger' => $this->logger,
                'uid' => $this->user['uid'],
                'login' => $this->user['login'],
                'level' => $this->user['level']
            ];
        }

        return [
            'logger' => false
        ];
    }

    protected function entry(string $login, string $password)
    {
        // Подключить базу данных
        $db = $this->container->get('db');

        // Обработать логин  и пароль
        $login =  Misc::str($login, $this->container);
        $password = Misc::str($password, $this->container);

        // Выполнить запрос
        $result = $db->query('SELECT u.uid, u.login, u.level, u.coins, us.shift_time, us.local, us.theme, us.post_page
            FROM user AS u
            LEFT JOIN user_settings AS us ON us.user_uid = u.uid
            WHERE login = "' . $login . '" AND password = "' . $password . '"LIMIT 1'
        );

        // Если пользователь найден
        if ($user = $result->fetch_assoc()) {
            // Сохранить пользователя
            $this->user = $user;

            return true;
        }

        return ;
    }

    protected function logon()
    {
        // Подключить сессии, cookie
        $sess = $this->container->get('session');
        $cookie = $this->container->get('cookie');

        if ($sess->login && $sess->password) {
            return $this->entry($sess->login, $sess->password);
        }

        // Если у в куках есть данные о пользователе
        if ($cookie->login && $cookie->password) {

            // Если пользователь найден
            if ($this->entry($cookie->login, $cookie->password)) {

                $sess->login = $cookie->login;
                $sess->password = $cookie->password;

                return true;
            }

            return ;
        }

        return ;
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
