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

// Папка c конфиг файлами системы
const CONFIG = ROOT . 'config/';

// Папка c пакетами
const PACKS = ROOT . 'packages/';

// Системная папка NOMICMS (Без нее ваше приложение работать не будет)
const SYS = ROOT . 'system/';

// Папка в которую сохраняються временные данные.
const TEMP = ROOT . 'temp/';

// Ваш сайт - в нем содержаться ваши файлы, графика, шрифты и т.д.
const WEB = ROOT . 'web/';

// Темы оформления
const THEMES = WEB . 'themes/';

// Пакет, тема
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
