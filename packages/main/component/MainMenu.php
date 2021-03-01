<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Packages\Main\Component;

// Использовать
use System\Container\ContainerInterface;

/**
 * Класс MainMenu
 */
class MainMenu
{
    // Контейнер
    protected $container;

    // Конструктор
    public function __construct(ContainerInterface $container)
    {
        // Сохранить контейнер
        $this->container = $container;
    }

    // Показать навигацию
    public function showNav(){}

    // Показать боковую панель
    public function showSidebar(){}

    // Показать главное меню
    public function show(){}
}
