<?php
/**
 * Copyright © ExtDN. All rights reserved.
 */

declare(strict_types=1);

namespace Extdn\Sniffs\Classes;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Class StrictTypesSniff
 * @package Extdn\Sniffs\Classes
 */
class StrictTypesSniff implements Sniff
{
    /**
     * @var array
     */
    public $supportedTokenizers = ['PHP'];

    /**
     * @var string
     */
    protected $message = 'Define declare(strict_types=1)';

    /**
     * @return array|int[]
     */
    public function register()
    {
        return [T_CLASS];
    }

    /**
     * @param File $phpcsFile
     * @param int $stackPtr
     * @return int|void
     */
    public function process(File $phpcsFile, $stackPtr)
    {

        $tokens = $phpcsFile->getTokens();


        $hasDeclareStrictTypes = false;

        if ($tokens[$stackPtr]['code'] === T_DECLARE) {
            $lineEnd = $phpcsFile->findNext([T_SEMICOLON], $stackPtr);
            // extract all tokens between first declare and namespace start
            $tokens = \array_slice($tokens, $stackPtr, $lineEnd - 1);

            $hasDeclareStrictTypes = $this->hasDeclareStrictTypes($tokens);
        }

        if($hasDeclareStrictTypes === false)
        {
            $error = $this->message . 'Not Found:';
            $phpcsFile->addWarning($error, null, 'NotFound');
        }

    }

    /**
     * Checks has the File a
     * @param array $tokens
     * @param $start
     * @return bool
     */
    private function hasDeclareStrictTypes(array $tokens): bool
    {

        $containsStrictType = false;
        $isEnabled = false;

        foreach ($tokens as $token) {

            if ($token['code'] === T_STRING && $token['content'] === 'strict_types') {
                $containsStrictType = true;
            }

            if ($token['code'] === T_LNUMBER && $token['content'] === '1') {
                $isEnabled = true;
            }
        }

        return $containsStrictType && $isEnabled;
    }
}
