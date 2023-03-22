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
use Nomicms\Component\Container\Exception\DependencyNotFound;
use ReflectionNamedType;
use Closure;

// Dependencies
class Dependencies
{
    // Параметры
    private $userParams = [];

    // Установить параметры
    protected function setUserParams(array $userParams = []): void
    {
        $this->userParams = $userParams;
    }

    // Получить зависимости
    protected function get(array $params = []): array
    {
        // Список зависимостей
        $dependences = [];

        // Разобрать параметры зависимости
        foreach ($params as $param) {
            // Тип евляеться определением
            if ($param->getType() instanceof ReflectionNamedType) {
                // Получить тип
                $type = $param->getType();

                // Тип евляеться встроенным
                if ($type->isBuiltin()) {

                    // Тип указан в параметрах
                    if ($this->has($param->name)) {

                        $dependences[] = $this->getDependences($param->name);

                    // Тип указан в параметрах по позиции
                    } elseif ($this->has($param->getPosition())) {

                        $dependences[] = $this->userParams[$param->getPosition()];

                    // Тип не указан в параметрах но установлено по умолчанию
                    } elseif ($param->isDefaultValueAvailable()) {

                        $dependences[] = $param->getDefaultValue();

                    // Тип не указан в параметрах
                    } else
                        throw new DependencyNotFound("Тип {$param->name} в {$this->reflector->getName()} не передан в конструктор");
                // Тип не встроеный
                } else {
                    $dependences[] = $this->getSearch($type->getName());
                }

            // Тип не являеться определением, и указан в параметрах
            } elseif ($this->has($param->name)) {

                $dependences[] = $this->getDependences($param->name);

            // Тип не являеться определением, установлен по умолчанию
            } elseif ($param->isDefaultValueAvailable()) {

                $dependences[] = $param->getDefaultValue();

            // Тип не являеться определением, не установлен по умолчанию
            } else
                throw new DependencyNotFound("Тип {$param->name} в {$this->reflector->getName()} не должен быть пустым");
        }

        return $dependences;
    }

    // Получить
    private function getDependences(string $name)
    {
        $dependency = $this->userParams[$name];

        return $this->getClosure($dependency);
    }

    private function has(string|int $name)
    {
        return isset($this->userParams[$name]);
    }

    // Получить анонимную функцию
    private function getClosure($di)
    {
        return  $di instanceof Closure
                ? $di()
                : $di;
    }

    // Проверить контейнер
    private function hasContainer(string $name): bool
    {
        // Container
        return  'Nomicms\Component\Container\ContainerInterface' == $name ||
                'Nomicms\Component\Container\Container' == $name;
    }

    // Поиск в контейнере зависимости
    private function getSearch(string $name)
    {
        // Если ищем сам контейнер
        if ($this->hasContainer($name)) {
            return $this->container;
        }

        // Если namespace, получить имя зависимости
        if (strpos($name, '\\') !== false) {
            $name = $this->container->getName($name);
        }

        // Отдать
        return $this->container->get($name);
    }
}
