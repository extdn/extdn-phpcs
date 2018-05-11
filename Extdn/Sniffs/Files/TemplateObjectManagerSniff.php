<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */

declare(strict_types=1);

namespace Extdn\Sniffs\Files;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Class StrictTypesSniff
 * @package Extdn\Sniffs\Classes
 */
class TemplateObjectManagerSniff implements Sniff
{

    private const TEMPLATE_EXTENSION_LIST = ['.phtml'];

    /**
     * @inheritdoc
     */
    public function register()
    {
       return [T_OPEN_TAG];
    }

    /**
     * {@inheritdoc}
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        // TODO: Implement process() method.
    }
}
