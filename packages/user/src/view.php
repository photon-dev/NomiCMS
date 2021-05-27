<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

if (isset($userLogin)) {
    $text = "Привет. Твой Login {$userLogin}";
}


if (isset($userId)) {
    $text = "Привет. Твой id {$userId}";
}



// Добавить данные
$view->set('user.view', $text, 'text');

// Рендерить
$view->render('user.view');
