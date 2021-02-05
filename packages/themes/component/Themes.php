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
    // Полный путь
    protected $path = WEBSITE . 'themes/';

    // Тема оформления
    protected $theme = 'custom';

    // Конструктор
    public function __construct(Config $config, User $user)
    {
        // Загрузить настройки тем оформлений
        $settings = $config::load('themes/config/settings', PACKAGE);

        // Если пользователь, то тема пользовательская
        // В другом случае, тема системная
        $this->theme = $user->logger ? $user->user['theme'] : $settings['theme'];

    }

    // Установить путь к теме
    public function setPath()
    {
        if (! is_dir($this->path . $this->theme . DS)) {
            die("Тема {$this->theme} не найдена");
        }

        if (! file_exists($this->path . $this->theme . DS . 'theme.php')) {
            die("Файл конфигурации темы {$this->theme} не найдена");
        }


        dd($this->path . $this->theme . DS);
        //$path = THEMES . $this->theme . DS;
        /*
        if ($this->has($path)) {

            $this->path = $path;

            return true;
        } elseif (is_dir(THEMES . 'custom/')) {

            $this->path = THEMES . 'custom/';

        } else
            die('Папка с темой не обнаружена');

        return false;
        */
    }

    // Проверить папку и файл конфиг
    protected function has(string $path)
    {
        if (! is_dir(THEMES . $path)) {
            die('Папка с темы оформления не найден');
        }

        if (file_exists($path . 'theme.php')) {
            die('Файл конфигурации темы оформления не найден');
        }

        return '';
    }

    // Установить тему оформления
    public function verify()
    {
        dd('ok');
    }

    // Получить путь к теме
    public function getPath()
    {
        return $this->path;
    }
}
