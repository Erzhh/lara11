<?php

namespace App\Domain\Patterns\Singleton\Actions;
use App\Domain\Patterns\Singleton\Realizations\SalaryCalc;
use App\Domain\Patterns\Singleton\Realizations\SalaryCalcSingleton;

class SomeCalculationAction
{

    public function run(): void
    {

        $start = microtime(true);
        for ($i = 0; $i <= 1000; $i++) {
            SalaryCalcSingleton::getInstance()->run($i);
        }
        $end = microtime(true);
        echo "Время с singleton: " . ($end - $start) . " секунд\n";


        $start = microtime(true);
            for ($i = 0; $i <= 1000; $i++) {
                (new SalaryCalc())->run($i);
            }
        $end = microtime(true);
        ray( "Время без singleton: " . ($end - $start) . " секунд\n" );

    }

}
