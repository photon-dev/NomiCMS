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
use ReflectionFunction;
use System\Container\Exception\DependencyNotFound;

/**
 * Отражение функции
 */
class Anon  extends Dependencies
{
    // Контейнер
    protected $container;

    // Отражение анонимной функции
    protected $reflector;

    // Конструтор
    public function __construct(ContainerInterface $container)
    {
        // Установить контейнер
        $this->container = $container;
    }

    // Создать отражение функции
    public function __invoke(object $dependency, array $params)
    {
        // Создать отражение
        $reflector = new ReflectionFunction($dependency);
        $this->reflector = $reflector;

        // Установить пользовательские параметры
        $this->setUserParams($params);

        // Получить параметры зависимости
        $params = $reflector->getParameters();

        // Получить зависимости
        $dependences = $this->get($params);

        // Получить функцию
        return call_user_func_array($dependency, $dependences);
    }


}
