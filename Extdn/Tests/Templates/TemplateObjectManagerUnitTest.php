<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */
declare(strict_types=1);

namespace Extdn\Tests\Templates;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class TemplateObjectManagerUnitTest extends AbstractSniffUnitTest
{

    /**
     * @inheritdoc
     */
    protected function getErrorList()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    protected function getWarningList()
    {
        return [3 => 1];
    }
}
