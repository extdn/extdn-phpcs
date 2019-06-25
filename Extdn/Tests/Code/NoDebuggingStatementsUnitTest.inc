<?php
namespace Extdn\Samples\Code;

class NoDebuggingStatements
{
    public function __construct()
    {
        die('Whoops');
    }
}
