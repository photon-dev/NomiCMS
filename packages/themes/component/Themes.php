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
use Nomicms\Component\Container\ContainerInterface;
use Exception;

/**
 * Класс Themes
 */
class Themes
{
    // Контейнер зависимостей
    protected $container;

    // Полный путь
    protected $path = THEMES;

    // Тема оформления
    protected $theme = 'custom';

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;

        // Получить тему
        $this->theme = $this->getTheme();

        // Проверить наличие тем
        if ($message = $this->has()) {
            echo $message;
            die;
        }
    }

    protected function getTheme(): string
    {
        // Получить зависимость user
        $user = $this->container->get('user');

        // Если пользователь авторизован
        if ($user->logger) {
            // Установить тему пользователя
            return $user->getUser()['theme'];
        }

        // Получить зависимость user
        $config = $this->container->get('config')::load('themes/settings', PACKAGE);

        // Установить тему по умолчанию
        return $config['theme'];
    }

    // Проверить папки, файлы нужны для работы с темой
    public function has(): bool
    {
        // Если папка темы не найдена
        if (! is_dir($this->path . $this->theme . DS)) {
            return "Тема {$this->theme} не найдена";
        }

        // Если config темы не найден
        if (! file_exists($this->path . $this->theme . DS . 'theme.php')) {
            return "Файл конфигурации темы {$this->theme} не найдена";
        }

        // Если системная тема не найдена
        if (! is_dir($this->path . 'custom/')) {
            return 'Традиционная тема не найдена';
        }

        return false;
    }

    // Получить путь к теме
    public function getPath(bool $priority = true): string
    {
        if ($priority) {
            return $this->path . $this->theme . '/view/';
        }

        // Получить имя пакета
        $package = $this->container->get('config')::get('route')['package'];

        // Показать
        return PACKAGES . $package  . '/view/';
    }
}
