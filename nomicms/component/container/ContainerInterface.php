<<<<<<< current
<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Container;

/**
 * Интерфейс контейнера
 */
interface ContainerInterface
{
    // Установить
    public function set($service);

    // Получить
    public function get(string $name, array $params = []);

    // Проверить в установленных
    public function has(string $name): bool;

    // Проверить в используемых
    public function hasUsed(string $name): bool;

    // Удалить
    public function remove(string $name): bool;

    // Получить список установленных
    public function getInstalled(): array;

    // Получить список используемых
    public function getUsed(): array;
}
=======
<?php declare(strict_types=1);
/**
 * NomiCMS - Content Management System
 *
 * @author Tosyk, Photon
 * @package nomicms/NomiCMS
 * @link   http://nomicms.ru
 */

namespace Nomicms\Component\Container;

/**
 * Интерфейс контейнера
 */
interface ContainerInterface
{
    // Установить
    public function set($service);

    // Получить
    public function get(string $name, array $params = []);

    // Проверить в установленных
    public function has(string $name): bool;

    // Проверить в используемых
    public function hasUsed(string $name): bool;

    // Удалить
    public function remove(string $name): bool;

    // Получить список установленных
    public function getInstalled(): array;

    // Получить список используемых
    public function getUsed(): array;
}
>>>>>>> before discard
