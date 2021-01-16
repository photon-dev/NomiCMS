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
use System\Container\Definition\ReflectionClosure;
use System\Container\Exception\ContainerNotFound;
use Closure;

/**
 * Контейнер
 */
class Container extends ContainerParse implements ContainerInterface
{
    // Возможность игнорировать переопределение служб
    protected $ignoreOverride = false;

    // Установленные службы
    protected $installed = [];

    // Используемые службы
    protected $used = [];

    // Отражение класса
    protected $reflector;

    // Отражение анонимной функции
    protected $closure;

    // Конструктор
    public function __construct(array $config = [], Reflector $reflector = null, ReflectionClosure $closure = null)
    {
        // Установить переопределение служб
        $this->ignoreOverride = $config['ignoreOverride'] ?? false;

        // Установить отражения
        $this->reflector = $reflector ?: new Reflection($this);
        $this->closure = $closure ?: new ReflectionClosure($this);
    }

    // Установить службу
    public function set($service, $name = ''): self
    {
        // Если это не анонимная функция
        if (! ($service instanceof Closure)) {
            // Получить имя службы
            $name = $this->getName($service);
        }

        // Проверить службу
        if ($this->has($name) && ! $this->ignoreOverride) {
            throw new ContainerNotFound("Служба {$name} уже установлена. Переопределение выключено (ignoreOverride = false).");
        }

        if ($this->ignoreOverride) {
            unset($this->used[$name]);
        }

        // Сохранить службу
        $this->installed[$name] = $service;

        return $this;
    }

    // Получить службу
    public function get(string $name, array $params = [])
    {
        // Если служба уже используеться возращаем ее
        if (isset($this->used[$name]) && array_key_exists($name, $this->used)) {
            return $this->used[$name];
        }

        // Если служба не установлена
        if (! $this->has($name)) {
            throw new ContainerNotFound("Служба {$name} не установлена");
        }

        // Получить службу
        $service = $this->installed[$name];
        unset($this->installed[$name]);

        // Собрать службу
        $build = $this->build($service, $params);

        // Показать
        return $this->used[$name] = $build;
    }

    // Собрать службу
    protected function build($service, array $params)
    {
        // Если служба это анонимная функция
        if ($service instanceof Closure) {
            $closure = $this->closure;

            // Показать
            return $closure($service);
        }

        // Создать отражение
        $reflector = $this->reflector->create($service);

        // Получить конструктор
        if (NULL === $reflector->getConstructor()) {
            return $reflector->newInstance();
        }

        // Получить зависимости
        $dependences = $this->reflector->di($params);

        // Показать
        return $reflector->newInstanceArgs($dependences);
    }

    // Поиск в установленных служб
    public function has(string $name): bool
    {
        return (isset($this->installed[$name]) && array_key_exists($name, $this->installed));
    }

    // Получить список установленных служб
    public function getInstalled(): array
    {
        return $this->installed;
    }

    // Получить список используемых служб
    public function getUsed(): array
    {
        return $this->used;
    }
}
