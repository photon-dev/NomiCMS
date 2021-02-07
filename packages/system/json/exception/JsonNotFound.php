<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Json\Exception;

// Использовать
use Exception;

// Сервис не найден
class JsonNotFound extends Exception
{
    /*
    // Коды ощибок
    protected $errors = [
        0 => 'Имя файла :s занято',
        1 => 'Файл :s не найден',
        2 => 'Файл :s недоступен для записи',
        3 => 'Файл :s недоступен для чтения'
    ];

    public function __construct(string $fileName = '', int $code = 0)//: Exception
    {
        $message = str_replace(':s', $fileName, $this->errors[$code]);

        parent::__construct($message);

        return $this;
    }
*/
}
