<?php
declare(strict_types=1);

namespace Extdn\Tests\Blocks;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class NoSetTemplateInBlockTest extends AbstractSniffUnitTest
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
        return [
            8 => 1,
        ];
    }
}