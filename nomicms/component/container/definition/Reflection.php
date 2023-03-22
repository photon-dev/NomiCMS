<<<<<<< current
<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Container\Definition;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Container\Definition\Dependencies;
use ReflectionClass;
use Nomicms\Component\Container\Exception\DependencyNotFound;

/**
 * Отражение класса
 */
class Reflection extends Dependencies
{
    // Контейнер
    protected ContainerInterface $container;

    // Отражение
    protected ReflectionClass $reflector;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // Создать отражение
    public function __invoke($dependency, array $params)
    {
        // Создать отражение
        $reflector = new ReflectionClass($dependency);

        if (! $reflector->isInstantiable()) {
            throw new DependencyNotFound("Не возможжно создать экземпляр зависимости: {$dependency}");
        }

        $this->reflector = $reflector;

        // Если конструктор не обнаружен
        if (NULL === $reflector->getConstructor()) {
            return $reflector->newInstance();
        }

        // Установить пользовательские параметры
        $this->setUserParams($params);

        // Получить параметры консруктора
        $params = $reflector->getConstructor()->getParameters();

        // Получить зависимости
        $dependences = $this->get($params);

        return $reflector->newInstanceArgs($dependences);
    }
}
<<<<<<< HEAD
=======
=======
<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Container\Definition;

// Использовать
use Nomicms\Component\Container\ContainerInterface;
use Nomicms\Component\Container\Definition\Dependencies;
use ReflectionClass;
use Nomicms\Component\Container\Exception\DependencyNotFound;

/**
 * Отражение класса
 */
class Reflection extends Dependencies
{
    // Контейнер
    protected ContainerInterface $container;

    // Отражение
    protected ReflectionClass $reflector;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // Создать отражение
    public function __invoke($dependency, array $params)
    {
        // Создать отражение
        $reflector = new ReflectionClass($dependency);

        if (! $reflector->isInstantiable()) {
            throw new DependencyNotFound("Не возможжно создать экземпляр зависимости: {$dependency}");
        }

        $this->reflector = $reflector;

        // Если конструктор не обнаружен
        if (NULL === $reflector->getConstructor()) {
            return $reflector->newInstance();
        }

        // Установить пользовательские параметры
        $this->setUserParams($params);

        // Получить параметры консруктора
        $params = $reflector->getConstructor()->getParameters();

        // Получить зависимости
        $dependences = $this->get($params);

        return $reflector->newInstanceArgs($dependences);
    }
}
>>>>>>> 088008d84652c867b6964cc9f087fab751467ad3
>>>>>>> before discard
