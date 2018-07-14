<?php
declare(strict_types=1);

namespace Extdn\Utils;

/**
 * Class TestPattern
 *
 * @package Extdn\Utils
 */
class TestPattern
{
    /**
     * @param string $className
     *
     * @return bool
     */
    static public function isTestClass(string $className): bool
    {
        if (strstr($className, '\\Test\\')) {
            return true;
        }

        if (preg_match('/Test$/', $className)) {
            return true;
        }

        return false;
    }
}
