<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */

declare(strict_types=1);

namespace Extdn\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use Extdn\Utils\Reflection;

/**
 * Class ObjectManagerSniff
 *
 * @package Extdn\Sniffs\Classes
 */
class ObjectManagerSniff implements Sniff
{
    /**
     * @var string
     */
    protected $message = 'The ObjectManager should not be injected into the constructor';

    /**
     * @inheritdoc
     */
    public function register()
    {
        return [T_CLASS];
    }

    /**
     * {@inheritdoc}
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $className = Reflection::findClassName($phpcsFile);
        if (empty($className)) {
            return false;
        }

        // Make sure to load the file itself, so that autoloading can be skipped
        include_once($phpcsFile->getFilename());

        $dependencyClasses = Reflection::getClassDependencies($className);
        foreach ($dependencyClasses as $dependencyClass) {
            if ($this->isObjectManagerAllowedWithClass($className)) {
                continue;
            }

            if (!$this->isInstanceOfObjectManager($dependencyClass->getName())) {
                continue;
            }

            $warning = 'The dependency "\\' . $dependencyClass->getName() . '" is not allowed here.';
            $phpcsFile->addWarning($warning, null, 'warning');
        }
    }

    /**
     * @param string $className
     *
     * @return bool
     */
    private function isObjectManagerAllowedWithClass(string $className): bool
    {
        if (preg_match('/([a-zA-Z]+)(Factory|Builder)$/', $className)) {
            return true;
        }

        if (preg_match('/Proxy$/', $className)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $className
     *
     * @return bool
     */
    private function isInstanceOfObjectManager(string $className): bool
    {
        if (strstr($className, 'ObjectManager')) {
            return true;
        }

        return false;
    }
}
