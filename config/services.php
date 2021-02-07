<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Список требуемых служб
 */
return [
    // Config
    System\Config\Config::class,

     // Json
     System\Json\Json::class,

     // Config
     System\Router\Router::class,

     // Database
     System\Database\DB::class,

     // User
     Packages\User\Component\User::class,

     // Request
     System\Http\Request\Request::class,

     // Request
     System\Http\Cookie\Cookie::class,

     // Response
     System\Http\Response::class,

     // View
     System\View\View::class,

     // Themes
     Packages\Themes\Component\Themes::class
];
