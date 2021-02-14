<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$view->title = 'Главная страница';
$view->desc = 'Описание главной страницы';
$view->keywords = 'Ключевые слова';


$cookie = $container->get('cookie');
$session = $container->get('session');

/*
$session->login([
    'login' => 'Photon',
    'pass' => 8544450
], true);
*/

//$session->login = 'Photon';

// Установить заголовок
//$cookie->login('Photon', ['expires' => TIME+60*60*24, 'path' => '/']);

dd($session->login);

$post = [
    'welcome' => 'Гость'
];

$view->set($post, 'index');

$view->render('index');
