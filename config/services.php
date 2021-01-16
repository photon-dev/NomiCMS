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

     // Database
     System\Database\DB::class,

     // User
     Packages\User\Component\User::class,

     // View
     System\View\View::class,

     // Themes
     Packages\Themes\Component\Themes::class,

     // Response
     System\Response\Response::class
];
