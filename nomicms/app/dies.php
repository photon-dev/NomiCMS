<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Список требуемых di
 */
return [
    // Config
    Nomicms\Component\Config\Config::class,

    // Json
    Nomicms\Component\Json\Json::class,

    // Config
    Nomicms\Component\Router\Router::class,

    // Database
    Nomicms\Component\Database\DB::class,

    // User
    Packages\User\Component\User::class,

    // Session
    Nomicms\Component\Http\Session\Session::class,

    // Cookie
    Nomicms\Component\Http\Cookie\Cookie::class,

    // Request
    Nomicms\Component\Http\Request\Request::class,

    // Response
    Nomicms\Component\Http\Response\Response::class,

    // Обработчик ошибок
    [
        'error',
        Nomicms\Component\Error\DisplayError::class
    ],

    // View
    Nomicms\Component\View\View::class,

    // Themes
    Packages\Themes\Component\Themes::class,

    // Pagination
    Nomicms\Component\Text\Pagination::class
];
