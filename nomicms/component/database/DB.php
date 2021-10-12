<?php
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Database;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Config\Config;
use mysqli;

/**
 * Класс Database
 */
class DB extends mysqli
{
    // Конструктор
    public function __construct(Config $config)
    {
        // Получить настройки базы данной
        $db = $config::load('database', false);

        // Подключиться к базе данной
        parent::__construct($db['server'], $db['user'], $db['pass'], $db['base']);

        // Проверить статус подключения
        if ($this->connect_errno) {
            echo '<b>Не удалось подключиться к базе данной</b><br />
            <b>Ощибка:</b> ' . $this->connect_errno .'<br />
            <b>Описание:</b> ' . $this->connect_error;
            die;
        }

        // Установить кодировку
        $this->set_charset('utf8mb4');
    }

    // При завершение работы класса, закрыть соединение базой
    public function __destruct()
    {
        if (!$this->connect_errno) {
            $this->close();
        }
    }
}
