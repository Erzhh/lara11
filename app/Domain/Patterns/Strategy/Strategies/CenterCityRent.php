<?php

namespace App\Domain\Patterns\Strategy\Strategies;

use Domain\Patterns\Strategy\Interfaces\RentCalcInterface;

class CenterCityRent implements RentCalcInterface
{
    public function calculate(): float
    {
        return 4500;
    }

}
