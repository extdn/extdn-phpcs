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
    protected $message = 'No debugging statements should be added to production code.';

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

        foreach ($tokens as $token) {
            if (!isset($token['type']) || !isset($token['content'])) {
                continue;
            }

            $exitFunctions = ['exit', 'die'];
            if ($token['type'] == 'T_EXIT' && in_array($token['content'], $exitFunctions)) {
                $message = $this->message;
                $message .= ' Function "die()" was found in the code.';
                $phpcsFile->addWarning($message, $stackPtr, 'die');
                continue;
            }

            $debuggingFunctions = ['print_r', 'var_export', 'var_dump'];
            if ($token['type'] == 'T_STRING' && in_array($token['content'], $debuggingFunctions)) {
                $message = $this->message;
                $message .= ' Function "var_export()" was found in the code.';
                $phpcsFile->addWarning($message, $stackPtr, 'var_export');
                continue;
            }
        }
    }
}

