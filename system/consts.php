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
const WEBSITE = ROOT . 'website/';

// Темы оформления
const THEMES = WEBSITE . 'themes/';

// Если это пакет
const PACKAGE = true;
