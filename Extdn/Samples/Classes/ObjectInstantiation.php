<?php

declare(strict_types=1);

namespace Extdn\Samples\Classes;

class ObjectInstantiation
{
    public function instantiateSomeObjects()
    {
        new \DateTime('yesterday');

        new stdclass;

        $className = 'stdclass';

        new $className;

        $anonymous = new class implements \Countable {
            public function count()
            {
                return 0;
            }
        };

        $e = new Exception;

        throw $e;

        throw new Exception;
    }
}
