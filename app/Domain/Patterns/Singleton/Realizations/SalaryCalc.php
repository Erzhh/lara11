<?php

namespace App\Domain\Patterns\Singleton\Realizations;

class SalaryCalc
{
    public int $salary = 10;

    public function run(int $value)
    {
        $this->salary = $this->salary * $value;
    }

}
