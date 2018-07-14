<?php
declare(strict_types=1);

namespace Extdn\Utils;

use PHP_CodeSniffer\Files\File;
use ReflectionClass;
use ReflectionException;

/**
 * Class Reflection
 *
 * @package Extdn\Utils
 */
class Reflection
{
    /**
     * @param string $className
     *
     * @return array
     */
    static public function getClassDependencies(string $className): array
    {
        try {
            $class = new ReflectionClass($className);
            $constructor = $class->getConstructor();
            if (empty($constructor)) {
                return [];
            }

            $parameters = $constructor->getParameters();
            if (empty($parameters)) {
                return [];
            }

            $dependencyClasses = [];
            foreach ($parameters as $parameter) {
                $dependencyClass = $parameter->getClass();
                if (empty($dependencyClass)) {
                    continue;
                }

                $dependencyClasses[] = $dependencyClass->getName();
            }

            return $dependencyClasses;

        } catch (ReflectionException $reflectionException) {
            return [];
        }
    }

    /**
     * @param File $phpcsFile
     *
     * @return string
     */
    static public function findClassName(File $phpcsFile): string
    {
        $tokens = $phpcsFile->getTokens();

        $namespaceParts = [];
        $namespaceFound = false;
        $className = '';
        $classFound = false;

        foreach ($tokens as $token) {
            if (!is_array($token)) {
                continue;
            }

            if ($token['type'] == 'T_NAMESPACE') {
                $namespaceFound = true;
                continue;
            } else if ($namespaceFound && $token['type'] == 'T_STRING') {
                $namespaceParts[] = $token['content'];
                continue;
            } else if ($namespaceFound && $token['type'] == 'T_SEMICOLON') {
                $namespaceFound = false;
                continue;
            }

            if ($token['type'] == 'T_CLASS') {
                $classFound = true;
                continue;
            } else if ($classFound && $token['type'] == 'T_STRING') {
                $className = $token['content'];
                $classFound = false;
                continue;
            }
        }

        if (!$className) {
            return '';
        }

        $className = implode('\\', $namespaceParts) . "\\$className";

        return $className;
    }
}
