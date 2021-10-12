<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

/**
 * Класс Авто-загрузки
 */
class Autoload
{
    // Статус
    protected static $status = false;

    // Список загружаемых файлов
    protected static $files = [];

    // Счетчик
    protected $counter = 0;

    // Тайминг (Время потраченное за загрузку всех файлов)
    protected $timing = 0;

    // Предварительная загрузка
    public static function bootstrap(): Autoload
    {
        if (self::$status === false) {
            self::$status = true;

            return new Autoload();
        }

        die('Повторная активация загрузчика не допустима');
    }

    // Установить список дополнительных файлов
    public static function setListFiles(array $list = [])
    {
        self::$files = $list;
    }

    // Конструктор
    protected function __construct()
    {
        // Запустить время
        $microtime = microtime(true);

        // Если установлен хоть файл - загрузить
        if (isset(self::$files[0])) {
            // Разобрать список доп. файлов
            foreach (self::$files as $file) {
                // Загрузить доп. файл
                $this->loadFile($file);
            }
        }

        //spl_autoload_extensions('.php,.inc');
        spl_autoload_register(['self', 'run'], true, true);

        // Сохранить потраченное время загрузки
        $this->timing += microtime(true) - $microtime;
    }

    // Запустить обработку
    protected function run(string $class)
    {
        // Запустить время
        $microtime = microtime(true);

        // Удалить пробелы, и вырезать ненужные символы
        $class = trim($class, '\\');
        $class = str_replace('\\', '/', $class);

        // Получить позицию последнего вхождения
        $pos = strrpos($class, '/');

        // Получить путь и имя файла
        $path = substr($class, 0, $pos + 1);
        $fileName = substr($class, $pos + 1);

        $class = strtolower($path) . $fileName;

        // Загрузить
        return $this->loadFile($class);

        // Сохранить потраченное время загрузки
        $this->timing += microtime(true) - $microtime;
    }

    // Непосредственная загрузка файла
    protected function loadFile(string $path)
    {
        // Путь к файлу
        $path = ROOT . $path . '.php';

        // Проверить
        if ($this->has($path)) {
            // Пополнить счетчик загрузок
            $this->counter++;

            // Загрузить
            return require_once $path;
        }
    }

    // Проверка файла
    protected function has(string $path)
    {
        // Проверить
        if (file_exists($path) === false) {
            $fileName = substr($path, strrpos($path, '/') + 1);

            throw new \Exception("Файл '{$fileName}' не найден. Проверьте путь '{$path}'");
        }

        return true;
    }

    // Получить счетчик
    public function getCounter(): int
    {
        return $this->counter;
    }

    // Получить тайминг
    public function getTiming(): float
    {
        return $this->timing;
    }
}

// Установить список дополнительных файлов
Autoload::setListFiles([
    'nomicms/consts',
    'nomicms/heplers'
]);

// Иницилизировать загрузчик
return $autoload = Autoload::bootstrap();
