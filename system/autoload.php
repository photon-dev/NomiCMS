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
    // Счетчик
    public $counter = 0;

    // Тайминг (Время потраченное за загрузку всех файлов)
    public $timing = 0;

    // Предварительная загрузка
    public static function bootstrap(): self
    {
        return new self();
    }

    // Конструктор
    protected function __construct()
    {
        // Загрузить доп. файлы
        $this->files();

        //spl_autoload_extensions('.php,.inc');
        spl_autoload_register(['Autoload', 'run'], true, true);
    }

    // Предварительно загрузить доп. файлы
    protected function files(): void
    {
        // Запустить время
        $microtime = microtime(true);

        // Получить список файлов
        $files = require ROOT . 'config/preload.php';

        foreach ($files as $file) {
            $this->loadFile($file);
        }

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

        //var_dump($class);

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
}

// Предварительная авто-загрузка загрузчика
$autoload = Autoload::bootstrap();

// Вывод загруженного класса
return $autoload;
