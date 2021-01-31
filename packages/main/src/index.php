<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view = $container->get('view.view');


$view->set('name', 'Гость');
$view->view('name');


$view->output();


//dd($view->themes->theme);

//return 'Компонент Main/index подключен';
