<?php

namespace Extdn\Samples\Classes;

use Magento\Framework\App\ObjectManager as CoreObjectManager;
use Magento\Framework\ObjectManagerInterface;

class ObjectManager
{
    public function __construct(
        ObjectManagerInterface $objectManager1,
        CoreObjectManager $objectManager2
    ) {
    }
}
