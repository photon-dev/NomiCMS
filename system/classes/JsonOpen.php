<?php
/**
 * Класс JsonOpen
 */
class JsonOpen
{
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

    public function get(bool $preend = false)
    {
        if ($this->has() === false) {
            throw new Exception("Файл {$this->fileName} не найден");
        }

        $data = file_get_contents($this->getFilePath());

        return json_decode($data, $preend);
    }

    // Проверить файл
    public function has()
    {
        if (file_exists($this->getFilePath())) {
            return true;
        }

        return false;
    }

    // Получить путь к файлу
    public function getFilePath()
    {
        return $this->path . $this->fileName . $this->ext;
    }
}
