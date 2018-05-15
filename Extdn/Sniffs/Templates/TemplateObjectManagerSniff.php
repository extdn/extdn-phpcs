<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */

declare(strict_types=1);

namespace Extdn\Sniffs\Templates;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/*
 * Class StrictTypesSniff
 * @package Extdn\Sniffs\Classes
 */
class TemplateObjectManagerSniff implements Sniff
{


    public $templateExtensionList  = ['.phtml'];
    /**
     * @var string
     */
    protected $message = 'Define instead of using ObjectManager in Template.';

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
        $tokens = $phpcsFile->getTokens();
        $fileName  = $phpcsFile->getFileName();
        $extension = substr($fileName, strrpos($fileName, '.'));

        if (\in_array($extension, $this->templateExtensionList, false) === false) {
            return;
        }

        foreach ($tokens as $line => $token) {
            if ($this->hasTokenMatch($token) === false) {
                continue;
            }

            $error = $this->message . ' Found: %s';
            $phpcsFile->addWarning($error, $line, 'Found', $token);
        }
    }


    public function hasTokenMatch($token)
    {
        if ($token['content'] !== 'ObjectManager') {
            return false;
        }

        return true;
    }
}
