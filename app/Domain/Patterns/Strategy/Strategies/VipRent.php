<?php

namespace App\Domain\Patterns\Strategy\Strategies;

use Domain\Patterns\Strategy\Interfaces\RentCalcInterface;

class VipRent implements RentCalcInterface
{
    public function calculate(): float
    {
       return 5000;
    }

}
