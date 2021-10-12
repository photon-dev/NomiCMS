<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

// Разделитель коталогов
const DS = '/';

// Системная директория
const CMS = ROOT . 'nomicms/';

// nomicms/app директория
const APP = CMS . 'app/';

// nomicms/config директория
const CONFIG = CMS . 'config/';

// Packages директория
const PACKAGES = ROOT . 'packages/';

// Themes директория
const THEMES = ROOT . 'themes/';

// Uploads директория
const UPLOADS = ROOT . 'uploads/';

// Пакет, тема
const SYSTEM = 0;
const PACKAGE = 1;
const THEME = 2;

// Временные Константы
const SECOND = 1; // Секунда
const MINUTE = 60; // Минута
const HOUR = 3600; // Час
const DAY = 86400; // День
const WEEK = 604800; // Неделя
const MONTH = 2592000; // Месяц
const YEAR = 31536000; // Год
const DECADE = 315360000; // Десятилетие
