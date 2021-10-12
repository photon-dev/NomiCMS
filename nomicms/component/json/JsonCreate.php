<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Json;

// Использовать
use Nomicms\Component\Json\Exception\JsonNotFound;

// Json сreate
class JsonCreate
{
    // Коды ощибок
    const NOT_FILENAME = 0;
    const NOT_FILE = 1;
    const NOT_WRITE = 2;
    const NOT_READ = 3;

    // Полный путь
    protected $path = '';

    // Имя файла
    protected $fileName = '';

    // Формат
    protected $ext = '.json';

    public function __construct(string $path, string $fileName)
    {
        $this->path = $path;
        $this->fileName = $fileName;

        return $this;
    }

    public function create(array $data = [])
    {
        //dd($fileName);
        if ($this->has()) {
            //return false;
            throw new JsonNotFound("Имя файла {$this->fileName} занято");
        }

        file_put_contents(
            $this->getFilePath(),
            json_encode($data, JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );

        chmod($this->getFilePath(), 0644);
        return true;
    }

    public function open($preend = false)
    {
        if ($this->has() === false) {
            throw new JsonNotFound("Файл {$this->fileName} не найден");
        }

        if ($this->hasRead() === false) {
            throw new JsonNotFound("Файл {$this->fileName} недоступен для чтения");
        }

        $data = file_get_contents($this->getFilePath());

        return json_decode($data, $preend);
    }

    public function getFilePath()
    {
        return $this->path . $this->fileName . $this->ext;
    }

    public function has()
    {
        if (file_exists($this->getFilePath())) {
            return true;
        }

        return false;
    }

    public function hasRead()
    {
        if (is_readable($this->getFilePath())) {
            return true;
        }

        return false;
    }


}
