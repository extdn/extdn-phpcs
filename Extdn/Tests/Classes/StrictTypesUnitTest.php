<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */
declare(strict_types=1);

namespace Extdn\Tests\Classes;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class StrictTypesUnitTest extends AbstractSniffUnitTest
{

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
    public function getWarningList()
    {
        return [1 => 1];
    }
}
