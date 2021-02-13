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

$post = [
    'welcome' => 'Гость'
];

$view->set($post, 'index');

$view->render('index');
