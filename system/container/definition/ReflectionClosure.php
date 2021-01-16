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
//use System\Container\Exception\ServiceNotFound;
use ReflectionFunction;
//use Exception;

// Отражение функции
class ReflectionClosure
{
    // Контейнер
    protected $container;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function __invoke(object $closure, array $params = [])
    {
        $reflector = new ReflectionFunction($closure);
        $result = $this->di($reflector->getParameters());

        return call_user_func_array($closure, $result);
    }

    // Получить зависимости
    protected function di(array $params): array
    {
        $result = [];

        foreach ($params as $key => $value) {

            if ($value->name == 'container') {

                $result[$key] = $this->container;

            } elseif ($name = $this->container->get($value->name)) {

                $result[$key] = $name;

            }// else {
                //throw new ServiceNotFound("Зависимость {$value->name} не определена");
            //}

        }

        return $result;
    }

    public function hasClonsure($name)
    {
        // code...
    }

}
