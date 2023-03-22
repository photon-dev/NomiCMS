<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Container;

// Использовать
use Nomicms\Component\Container\ContainerParse;
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Container\Definition\Reflection;
use Nomicms\Component\Container\Definition\Anon;
use Closure;
use Nomicms\Component\Container\Exception\DependencyNotFound;

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
    protected Reflection $reflector;

    // Отражение анонимной функции
    protected Anon $anon;

    // Конструктор
    public function __construct(Reflector $reflector = null, ReflectionClosure $anon = null)
    {
        // Установить отражения
        $this->reflector = $reflector ?: new Reflection($this);
        $this->anon = $anon ?: new Anon($this);
    }

    // Установить
    public function set($dependency, $name = ''): self
    {
        // Если это не анонимная функция
        if (! ($dependency instanceof Closure) && empty($name)) {
            $name = $this->getName($dependency);

        // Если имя не указано
        } elseif (empty($name)) {
            throw new DependencyNotFound("Имя зависимости для анонимной функции должно быть указано");
        }

        // Если зависимость не найден
        if ($this->has($name)) {
            throw new DependencyNotFound("Зависимость {$name} уже установлена");
        }

        // Сохранить
        $this->installed[$name] = $dependency;

        return $this;
    }

    // Получить
    public function get(string $name, array $params = [])
    {
        // Если зависимость уже используеться
        if ($this->hasUsed($name)) {
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
        // Если зависимость анонимная функция
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

    // Проверить в установленных
    public function has(string $name = ''): bool
    {
        return  !empty($name) &&
                isset($this->installed[$name]) &&
                array_key_exists($name, $this->installed);
    }

    // Проверить в используемых
    public function hasUsed(string $name = ''): bool
    {
        return  !empty($name) &&
                isset($this->used[$name]) &&
                array_key_exists($name, $this->used);
    }

    // Удалить
    public function remove(string $name): bool
    {
        // Если зависимость используеться
        if ($this->hasUsed($name)) {
            unset($this->used[$name]);
            return true;
        }

        // Если зависимость установлена
        if ($this->has($name)) {
            unset($this->installed[$name]);
            return true;
        }

        return false;
    }

    // Получить список установленных
    public function getInstalled(): array
    {
        return $this->installed;
    }

    // Получить список используемых
    public function getUsed(): array
    {
        return $this->used;
    }
}
