<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\Themes\Component;

// Использовать
use System\Container\ContainerInterface;
use System\Config\Config;
use Packages\User\Component\User;

/**
 * Класс Themes
 */
class Themes
{
    // Имя папки
    protected $theme = 'custom';

    // Полный путь
    protected $path = '';

    // Конструктор
    public function __construct(Config $config, User $user)
    {

        // Если пользователь, то тема пользовательская
        // В другом случае, тема системная
        if ($user->logger) {

            $this->theme = $user->user['theme'];

        } else {
            // Загрузить настройки тем оформлений
            $settings = $config::load('themes/config/settings', PACKAGE);

            $this->theme = $settings['theme'];
        }

        $theme = $config::pull($this->theme . '/theme', THEME);

        dd($theme);

        $this->setPath($theme);
    }

    // Установить тему оформления
    protected function setTheme()
    {
        // code...
    }

    // Установить путь к теме
    protected function setPath()
    {

        $path = THEMES . $this->theme . DS;

        if ($this->has($path)) {

            $this->path = $path;

            return true;
        } elseif (is_dir(THEMES . 'custom/')) {

            $this->path = THEMES . 'custom/';

        } else
            die('Папка с темой не обнаружена');

        return false;
    }

    // Проверить папку и файл конфиг
    protected function has(string $path)
    {
        return (is_dir($path) && file_exists($path . 'theme.php'));
    }

    // Получить путь к теме
    public function getPath()
    {
        return $this->path;
    }
}
