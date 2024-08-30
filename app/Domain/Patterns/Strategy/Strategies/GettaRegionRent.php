<?php

namespace App\Domain\Patterns\Strategy\Strategies;

use Domain\Patterns\Strategy\Interfaces\RentCalcInterface;

class GettaRegionRent implements RentCalcInterface
{
    public function calculate(): float
    {
        return 2000;
    }

}
