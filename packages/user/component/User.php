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
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Text\Misc;
use Nomicms\Component\View\View;

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
            $this->logger = $this->checkAccess();
        }

        // Установить для всех шаблонов
        $view->setAll(
            (object) $this->set(),
            'user'
        );
    }

    // Установить данные для всех шаблонов
    protected function set(): array
    {
        // Авторизован
        if ($this->logger) {
            return [
                'logger' => $this->logger,
                'uid' => $this->user['uid'],
                'level' => $this->user['level']
            ];
        }

        return [
            'logger' => false
        ];
    }

    // Авторизация
    protected function entry(string $token): bool
    {
        // Обработать токен
        $token = Misc::str($token, $this->container);

        // Запрос
        $query = 'SELECT u.uid, u.login, u.level, u.coins, us.shift_time, us.local, us.theme, us.post_page
            FROM user AS u
            LEFT JOIN user_settings AS us ON us.user_uid = u.uid
            WHERE token = "' . $token . '"LIMIT 1
        ';

        // Выполнить запрос
        $result = $this->container->get('db')->query($query);

        // Удачно
        if ($user = $result->fetch_assoc()) {
            // Сохранить пользователя
            $this->user = $user;

            // Завершить запрос
            $result->free();
            return true;
        }

        return false;
    }

    // Проверить доступ
    protected function checkAccess()
    {
        // Подключить cookie, session
        $session = $this->container->get('session');
        $cookie = $this->container->get('cookie');

        // Авторизация по сессии
        if ($session->token) {
            return $this->entry($session->token);
        }

        // Авторизация по кукам
        if ($cookie->token) {

            if ($this->entry($cookie->token)) {
                $session->token = $cookie->token;

                return true;
            }

            return false;
        }

        // Ничего не найдено
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

    // Получить аватар пользователя
    public function getAvatar($avatar): string
    {
        // Уровень пользователя не найден
        if ($avatar == NULL) {
             return 'none.jpg';
        }

        return $avatar;
        //return '<img src="/uploads/avatars/' . $avatar . '" alt="Alt">';
    }

    // Получить имя уровня
    public function getLevel(string $userlevel = ''): string
    {
        // Уровень пользователя не введён
        if (! empty($userLevel)) {
            $userlevel = $this->user['level'];
        }

        switch ($userlevel) {
            case '2':
                $level = 'mod';
                break;
            case '3':
                $level = 'adm';
                break;
            case '4':
                $level = 'dev';
                break;
            default:
                $level = 'user';
                break;
        }

        return $level;
    }

    // Получить имя уровня
    public function getLevelName(string $userlevel = ''): string
    {
        // Уровень пользователя не введён
        if (! empty($userLevel)) {
            $userlevel = $this->user['level'];
        }

        switch ($userlevel) {
            case '2':
                $level = 'Модератор';
                break;
            case '3':
                $level = 'Администратор';
                break;
            case '4':
                $level = 'Разработчик';
                break;
            default:
                $level = 'Пользователь';
                break;
        }

        return $level;
    }

    public function getStatus(string $status)
    {
        if (! empty($status)) {
            return Misc::output($status);
        }

        return false;
    }
}
