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
use System\Container\Exception\DependencyNotFound;
use ReflectionNamedType;

/**
 * Класс получения зависимостей
 *
 * Создан для того, что бы не создавать дубликацию кода
 * в двух других классах Anon и Reflection
 */
class Dependencies
{
    // Пользовательские параметры
    private $userParams = [];

    // Установить пользовательские параметры
    protected function setUserParams(array $userParams): void
    {
        $this->userParams = $userParams;
    }

    // Получить зависимости
    protected function get(array $params = []): array
    {
        // Список зависимостей
        $dependences = [];

        // Разобрать зависимости параметры
        foreach ($params as $param) {

            // Если тип евляеться определением имён типов
            if ($param->getType() instanceof ReflectionNamedType) {

                // Получить тип
                $type = $param->getType();

                // Если тип евляеться встроенным
                if ($type->isBuiltin()) {

                    // Если имя указано в пользовательских параметрах
                    if (isset($this->userParams[$param->name])) {

                        // Получить зависимость изходя из параметров
                        $dependency = $this->userParams[$param->name];

                        // Если зависимость это анонимная функция
                        if ($dependency instanceof Closure) {

                            $dependences[] = $dependency();

                        // В противном случае просто добавить
                        } else {
                            $dependences[] = $dependency;
                        }

                    // В противном случае, но указан по умолчанию
                    } elseif ($param->isDefaultValueAvailable()) {

                        $dependences[] = $param->getDefaultValue();

                    // в противном случае, вызвать ошибку
                    } else {
                        throw new DependencyNotFound("Не возможно получить параметр {$param->name} в {$this->reflector->getName()}");
                    }

                // В противном случае, вызвыть поиск по имени типа
                } else {
                    $dependences[] = $this->getSearch($type->getName());
                }


            // В противном случае, вызвать поиск по имени.
            } else {
                $dependences[] =  $this->getSearch($param->name);
            }

        }

        return $dependences;
    }

    // Поиск в контейнере зависимости
    protected function getSearch(string $name)
    {
        // Если ищем сам контейнер
        if ('System\Container\ContainerInterface' == $name) {
            return $this->container;
        }

        // Если namespace, получить имя зависимости
        if (strpos($name, '\\') !== false) {
            $name = $this->container->getName($name);
        }

        // Получить зависимость
        return $this->container->get($name);
    }
}
