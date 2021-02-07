<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace System\Container\Definition;

// Использовать
use System\Container\ContainerInterface;
use System\Container\Definition\Dependencies;
use ReflectionClass;
use System\Container\Exception\DependencyNotFound;

/**
 * Отражение класса
 */
class Reflection extends Dependencies
{
    // Контейнер
    protected $container;

    // Отражение
    protected $reflector;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        // Установить контейнер
        $this->container = $container;
    }

    // Создать отражение функции
    public function __invoke($dependency, array $params)
    {
        // Создать отражение
        $reflector = new ReflectionClass($dependency);

        if ($reflector->isInstantiable() === false) {
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
