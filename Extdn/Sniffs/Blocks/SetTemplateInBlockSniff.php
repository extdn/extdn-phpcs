<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */

declare(strict_types=1);

namespace Extdn\Sniffs\Blocks;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Class SetTemplateInBlockSniff
 * @package Extdn\Sniffs\Blocks
 */
class SetTemplateInBlockSniff implements Sniff
{
    /**
     * @var string
     */
    protected $message = 'Define $_template instead of using $this->setTemplate() in Block classes.';

    /**
     * @var array
     */
    public $supportedTokenizers = array(
        'PHP'
    );

    /**
     * @return array|int[]
     */
    public function register()
    {
        return array(T_CLASS);
    }

    /**
     * @param File $phpcsFile
     * @param int $stackPtr
     * @return int|void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        foreach ($tokens as $line => $token) {
            if ($this->hasTokenMatch($token) === false) {
                continue;
            }

            $error = $this->message . ' Found: %s';
            $data = array(trim($token['content']));
            $data = $token;
            $phpcsFile->addWarning($error, $line, 'Found', $data);
        }

        print_r($tokens);exit;
    }

    /**
     * @param array $token
     * @return bool
     */
    private function hasTokenMatch(array $token): bool
    {
        if ($token['content'] !== 'setTemplate') {
            return false;
        }

        return true;
    }
}