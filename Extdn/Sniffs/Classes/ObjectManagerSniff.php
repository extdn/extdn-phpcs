<?php
declare(strict_types=1);

namespace Extdn\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use Extdn\Utils\TestPattern;
use Extdn\Utils\Reflection;

/**
 * Class ObjectManagerSniff
 *
 * @package Extdn\Sniffs\Classes\Constructor
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

        if (TestPattern::isTestClass($className)) {
            return false;
        }

        $dependencyClasses = Reflection::getClassDependencies($className);
        foreach ($dependencyClasses as $dependencyClass) {
            if ($this->isObjectManagerAllowedWithClass($className)) {
                continue;
            }

            if (!$this->isInstanceOfObjectManager($dependencyClass)) {
                continue;
            }

            $warning = 'The dependency "\\' . $dependencyClass . '" is not allowed here.';
            $phpcsFile->addWarning($warning, 0, get_class($this), [], 8);
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
        if (strstr($className, '\\ObjectManager')) {
            return true;
        }

        return false;
    }
}
