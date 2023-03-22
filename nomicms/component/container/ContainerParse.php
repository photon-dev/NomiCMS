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
 * Класс ContainerParse
 */
class ContainerParse
{
    // Получить имя зависимости
    public function getName(string $name): string
    {
        // Получить позицию последнего вхождения
        $pos = strrpos($name, '\\');
        $name = substr($name, $pos + 1);

        return mb_strtolower($name);
    }
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
 * Класс ContainerParse
 */
class ContainerParse
{
    // Получить имя зависимости
    public function getName(string $name): string
    {
        // Получить позицию последнего вхождения
        $pos = strrpos($name, '\\');
        $name = substr($name, $pos + 1);

        return mb_strtolower($name);
    }
}
>>>>>>> before discard
