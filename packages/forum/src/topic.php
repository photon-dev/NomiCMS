<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

$forumId =  $forumId ?? false;
$forumSubId = $forumSubId ?? false;
$topicId = $topicId ?? false;

$view->title = 'Форум - Тема - ' . $topicId;

$view->put();
