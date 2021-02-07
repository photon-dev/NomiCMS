<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Система управления содержимым';

$view->add([
    'name' => 'Гость'
], 'index');

$view->render('index');

//dd($view->themes->theme);

//return 'Компонент Main/index подключен';
