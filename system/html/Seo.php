<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Html;

// Использовать
use System\Html\SeoInterface;

/**
 * Класс Seo
 */
class Seo implements SeoInterface
{
    // Заголовок страницы
    public $title = 'NomiCMS - Главная';

    // Описание страницы
    public $desc = 'Система управления содержимым';

    // Ключевые слова страницы
    public $keywords = 'Система управления содержимым';

    public function __construct(){}

    // Установить заголовок
    public function setTitle(string $text): void
    {
        $this->title = $text;
    }

    // Установить описание
    public function setDesc(string $text): void
    {
        $this->desc = $text;
    }

    // Установить ключевые слова
    public function setKeywords(string $text): void
    {
        $this->keywords = $text;
    }

    public function get(): array
    {
        return [
            'title' => $this->title,
            'desc' => $this->desc,
            'keywords' => $this->keywords
        ];
    }
}
