<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Text;

// Использовать
use System\Container\ContainerInterface;
use System\Http\Request\Request;
use System\View\View;

/**
 * Класс Pagination
 */
class Pagination
{
    // Список страниц
    public $pages = 1;

    // Выбранная страница
    public $page = 1;

    // Выбранная страница
    public $start = 0;

    // Вид
    protected $view;

    // Конструктор
    public function __construct(int $count, int $limit, Request $request, View $view)
    {
        // Сохранить вид
        $this->view = $view;

        // Вычеслить количество страниц
        $this->pages = ceil($count / $limit);

        if ($request->get->p) {
            $this->page = $this->getPage($request->get->p);
        }

        // Если не являеться числом, либо если страница больше общего количества страниц
        if (! is_numeric($this->page) && $this->page > $this->pages) {
            $view->showed = true;

            header('location: /error/404');
            die;
        }

        // Установить начальный счет
        $this->start = $limit * $this->page - $limit;
    }

    protected function getPage(string $page)
    {
        // Если страница указана и евляеться числом
        if ($page == 'end') {
            $page = $this->pages;
        }elseif (! empty($page) && is_numeric($page)) {
            $page = (int) $page;
        }

        // Если page меньше 1
        if ($page < 1) {
            return 1;
        }

        return $page;
    }

    public function view(View $view, string $url = '?')
    {
        $view->set('pagination', [
            'url' => $url,
            'page' => $this->page,
            'pages' => ($this->pages > 0) ? $this->pages : false
        ]);
    }
}
