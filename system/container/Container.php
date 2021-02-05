<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Container;

// Использовать
use System\Container\ContainerParse;
use System\Container\ContainerInterface;
use System\Container\Definition\Reflection;
use System\Container\Definition\Anon;
use Closure;
use System\Container\Exception\DependencyNotFound;

/**
 * Контейнер зависимостей
 *
 * Создан для быстрого получения, любого класса в другом классе
 */
class Container extends ContainerParse implements ContainerInterface
{
    // Установленные
    protected $installed = [];

    // Используемые
    protected $used = [];

    // Отражение класса
    protected $reflector;

    // Отражение анонимной функции
    protected $anon;

    // Конструктор
    public function __construct(array $config = [], Reflector $reflector = null, ReflectionClosure $anon = null)
    {
        // Установить отражения
        $this->reflector = $reflector ?: new Reflection($this);
        $this->anon = $anon ?: new Anon($this);
    }

    // Установить службу
    public function set($dependency, $name = ''): self
    {
        // Если это не анонимная функция
        if (! ($dependency instanceof Closure) && empty($name)) {
            // Получить имя зависимости
            $name = $this->getName($dependency);

        // Противном случае если имя не указано выдать ошибку
        } elseif (empty($name)) {
            throw new DependencyNotFound("Имя зависимости для анонимной функции должно быть указано");
        }

        // Если зависимость не найден и переопределение выключено, сообщить об этом
        if ($this->has($name)) {
            throw new DependencyNotFound("Зависимость {$name} уже установлена");
        }

        // Сохранить зависимость
        $this->installed[$name] = $dependency;

        return $this;
    }

    // Получить зависимость
    public function get(string $name, array $params = [])
    {
        // Если зависимость уже используеться возращаем ее
        if (isset($this->used[$name]) && array_key_exists($name, $this->used)) {
            return $this->used[$name];
        }

        // Если зависимость не установлена
        if (! $this->has($name)) {
            throw new DependencyNotFound("Зависимость {$name} не установлена");
        }

        // Получить зависимость
        $dependency = $this->installed[$name];
        unset($this->installed[$name]);

        // Собрать зависимость
        $build = $this->build($dependency, $params);

        // Показать
        return $this->used[$name] = $build;
    }

    // Собрать зависимость
    protected function build($dependency, array $params)
    {
        // Если зависимость анонимная функция, получить ее
        if ($dependency instanceof Closure) {
            $anon = $this->anon;

            // Показать
            return $anon($dependency, $params);
        }

        // Если зависимость класс
        $reflector = $this->reflector;

        // Показать
        return  $reflector($dependency, $params);
    }

    // Поиск в установленных зависимостях
    public function has(string $name = ''): bool
    {
        return (!empty($name) && isset($this->installed[$name]) && array_key_exists($name, $this->installed));
    }

    // Получить список установленных зависимостях
    public function getInstalled(): array
    {
        return $this->installed;
    }

    // Получить список используемых зависимостях
    public function getUsed(): array
    {
        return $this->used;
    }
}
