<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Главная страница';

$post = [
    'welcome' => 'Photon'
];

$view->set($post, 'index');

$view->render('index');

dd($view->themes->theme);
