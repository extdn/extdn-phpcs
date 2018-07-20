<?php
declare(strict_types=1);

namespace Extdn\Sniffs\Code;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

/**
 * Class NoDebuggingStatementsSniff
 * @package Extdn\Sniffs\File
 */
class NoDebuggingStatementsSniff implements Sniff
{
    /**
     * @var string
     */
    protected $message = 'Debugging statements should not be kept in production code.';

    /**
     * @var int
     */
    protected $severity = 8;

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
        $tokens = $phpcsFile->getTokens();
        $types = [T_EXIT, T_STRING];
        while ($stackPtr = $phpcsFile->findNext($types, $stackPtr)) {
            if (!$stackPtr || !isset($tokens[$stackPtr])) {
                break;
            }

            $token = $tokens[$stackPtr];
            $this->processToken($phpcsFile, $stackPtr, $token);
            $stackPtr++;
        }
    }

    /**
     * @param File $phpcsFile
     * @param int $stackPtr
     * @param array $token
     *
     * @return bool
     */
    private function processToken(File $phpcsFile, int $stackPtr, array $token): bool
    {
        if (!isset($token['type']) || !isset($token['content'])) {
            return false;
        }

        $exitFunctions = ['exit', 'die'];
        if ($token['type'] == 'T_EXIT' && in_array($token['content'], $exitFunctions)) {
            $message = $this->message;
            $message .= sprintf(' Function "%s()" was found.', $token['content']);
            $phpcsFile->addWarning($message, $stackPtr, $token['content']);
            return true;
        }

        $debuggingFunctions = ['print_r', 'var_export', 'var_dump'];
        if ($token['type'] == 'T_STRING' && in_array($token['content'], $debuggingFunctions)) {
            $message = $this->message;
            $message .= sprintf(' Function "%s()" was found.', $token['content']);
            $phpcsFile->addWarning($message, $stackPtr, $token['content']);
            return true;
        }

        return false;
    }
}

