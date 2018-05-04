<?php
namespace Extdn\Samples\Blocks;

class SetTemplateInBlock
{
    public function __construct()
    {
        $this->setTemplate('foobar.phtml');
    }
}
