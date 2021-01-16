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

/**
 * Класс Themes
 */
class Themes
{
    // Контейнер зависимостей
    protected $container;

    // Полный путь к шаблонам
    protected $path = THEMES;

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Установить контейнер
        $this->container = $container;

        $settings = $this->getSettings();

        $this->path = $this->getPathTheme($settings['theme']);
    }

    protected function getSettings()
    {
        $config = $this->container->get('config');

        return $config::pull('themes/config/settings', true, PACKAGE);
    }

    protected function parse()
    {
        return THEMES . $theme . DS;
    }

    // Проверить емееть ли папку тема
    public function getPathTheme(string $theme)
    {
        return THEMES . $theme . DS;
    }

    public function has(string $path)
    {
        return is_dir($path);
    }

    private function getPath()
    {
        return '';
    }
}
