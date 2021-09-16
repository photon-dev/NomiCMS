<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

 // Если уже авторизован
 if ($container->get('user')->logger) {
     go_die($container, '/');
 }

 // Установить имя страницы
 $view->title = 'Регистрация';
