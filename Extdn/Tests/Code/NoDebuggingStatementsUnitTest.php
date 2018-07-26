<?php
declare(strict_types=1);

namespace Extdn\Tests\Code;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class NoDebuggingStatementsUnitTest extends AbstractSniffUnitTest
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
        return [4 => 1];
    }
}
