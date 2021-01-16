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
use System\Container\Exception\ContainerNotFound;
use ReflectionClass;
use Closure;

// Отражение
class Reflection
{
    // Контейнер
    protected $container;

    // Отражение
    protected $reflector;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // Создать отражение
    public function create(string $service)
    {
        $reflector = new ReflectionClass($service);

        if ($reflector->isInstantiable() === false) {
            throw new ContainerNotFound("Не возможжно создать экземпляр службы: {$service}");
        }

        return $this->reflector = $reflector;
    }

    // Подключить дополнительные службы
    public function di(array $params)
    {
        // Зависимиости
        $dependences = [];

        // Получить параметры конструктора
        $getParams = $this->getConstructor()->getParameters();

        // Разобрать
        foreach ($getParams as $param) {

            // Если параметр не namespace
            if ($param->getType()->isBuiltin()) {

                // Если найдены переданные параметры
                if (isset($params[$param->name])) {

                    // Получить зависимость изходя из параметров
                    $dependency = $params[$param->name];

                    // Если зависимость это анонимная функция
                    if ($dependency instanceof Closure) {

                        $dependences[] = $dependency();

                    // Если зависимость не анонимная функция
                    } else {

                        $dependences[] = $dependency;

                    }

                // Если параметры не найдены, но указаны по умолчанию
                } elseif ($param->isDefaultValueAvailable()) {

                    $dependences[] = $param->getDefaultValue();

                // Если не указаны по умолчанию
                } else {
                    throw new ContainerNotFound("Не возможно передать параметр {$param->name} в {$this->reflector->getName()}");
                }
            // Если указан namespace
            } else {

                $dependences[] = $this->getSearch($param->getType()->getName());
            }
        }

        return $dependences;
    }

    // Поиск в контейнере выбранных служб
    protected function getSearch(string $name)
    {
        if ('System\Container\ContainerInterface' == $name) {
            return $this->container;
        }

        // Получить имя зависимости
        $name = $this->container->getName($name);

        // Получить зависимость
        return $this->container->get($name);
    }

    // Получить конструктор
    public function getConstructor()
    {
        return $this->reflector->getConstructor();
    }

    // Создать новый экземпляр
    public function newInstance()
    {
        return $this->reflector->newInstance();
    }

    public function newInstanceArgs(array $params)
    {
        return  $this->reflector->newInstanceArgs($params);
    }

    public function getReflector()
    {
        return $this->reflector;
    }
}
