<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */
declare(strict_types=1);

namespace Extdn\Tests\Classes;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Class ObjectManagerUnitTest
 *
 * @package Extdn\Tests\Classes
 */
class ObjectManagerUnitTest extends AbstractSniffUnitTest
{
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @inheritdoc
     */
    public function getErrorList()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getWarningList($testFile = '')
    {
        if ($testFile === 'ObjectManagerUnitTest.2.inc') {
            return [];
        }

        return [1 => 1];
    }
}
