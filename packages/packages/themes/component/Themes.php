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

        // Проверить
        $this->hasPaths();
    }

    // Проверить папки, файлы нужны для работы с темой
    public function hasPaths(): void
    {
        if (! is_dir($this->path . $this->theme . DS)) {

            die("Тема {$this->theme} не найдена");

        } elseif (! file_exists($this->path . $this->theme . DS . 'theme.php')) {

            die("Файл конфигурации темы {$this->theme} не найдена");

        } elseif (is_dir($this->path . 'custom/') === false) {

            die('Традиционная тема не найдена');
        }
    }

    // Получить путь к теме
    public function getPath(): string
    {
        return $this->path . $this->theme . '/view/';
    }
}
