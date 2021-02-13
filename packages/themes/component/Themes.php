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
        // Если пользователь авторизован
        // В другом случае, тема системная
        if ($user->logger) {
            $this->theme = $user->user['theme'];
        } else {
            // Загрузить настройки тем оформлений
            $settings = $config::load('themes/config/settings', PACKAGE);
            $this->theme = $settings['theme'];
        }
    }

    // Проверить папки, файлы нужны для работы с темой
    public function hasPaths(): bool
    {
        // Если папка темы не найдена
        if (! is_dir($this->path . $this->theme . DS)) {
            die("Тема {$this->theme} не найдена");
            return false;
        }

        // Если config темы не найден
        if (! file_exists($this->path . $this->theme . DS . 'theme.php')) {
            die("Файл конфигурации темы {$this->theme} не найдена");
            return false;
        }

        // Если системная тема не найдена
        if (! is_dir($this->path . 'custom/')) {
            die('Традиционная тема не найдена');
            return false;
        }

        return true;
    }

    // Получить путь к теме
    public function getPath(): string
    {
        return $this->path . $this->theme . '/view/';
    }
}
