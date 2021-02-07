<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

if (isset($errorId)) {
    return 'Внимание ошибка id' . $errorId;
} else {
    return 'Ошибка без id';
}
