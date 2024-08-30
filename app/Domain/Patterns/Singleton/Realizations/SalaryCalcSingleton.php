<?php

namespace App\Domain\Patterns\Singleton\Realizations;

use App\Domain\Patterns\Singleton\Traits\SingletonTrait;

class SalaryCalcSingleton
{
    use SingletonTrait;

    public int $salary = 10;

    public function run(int $value)
    {
        $this->salary = $this->salary * $value;
    }

}
