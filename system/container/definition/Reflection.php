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

        $getParams = $this->getConstructor()->getParameters();
        //$params = array_merge($getParams, $params);

        //dd($params);
        foreach ($getParams as $param) {
            $dependency = $param->getClass();

            if (null === $dependency) {
                if ($param->isDefaultValueAvailable()) {

                    $dependences[] = $param->getDefaultValue();

                } elseif (isset($params[$param->name])) {

                    $funs = $params[$param->name];

                    if ($funs instanceof Closure) {

                        $dependences[] = $funs();

                    } elseif (is_array($funs)) {

                        $dependences[] = $funs;

                    } else {
                        throw new ContainerNotFound("Не может быть переданы {$param->name} в {$this->reflector->getName()}");
                    }

                } else {
                    throw new ContainerNotFound("Не может быть разрешена классовая зависимость {$param->name}");
                }
            } else {

                $dependences[] = $this->getSearch($dependency->name);
            }
        }

        //dd($di);

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
