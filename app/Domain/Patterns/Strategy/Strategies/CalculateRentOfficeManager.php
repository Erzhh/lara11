<?php

namespace App\Domain\Patterns\Strategy\Strategies;

use Domain\Patterns\Strategy\Interfaces\RentCalcInterface;

class CalculateRentOfficeManager
{

    public function run()
    {
        $offices = ['GettaRegion', 'CenterCity', 'Vip'];

        $office = $offices[ array_rand($offices) ];

        $price = $this->calculate($office);

        $this->save($price);

    }

    private function save(int $price)
    {
        //save
    }

    private function calculate(string $office):int
    {
        $strategy = $this->setStrategy($office);

        return $strategy->calculate();
    }

    private function setStrategy(string $office): RentCalcInterface
    {
        $file_name = $office.'Rent';
        $file = __NAMESPACE__.'\\'.$file_name;

        throw_unless( class_exists($file), \Exception::class,"file not exist $file");

        return new $file;;
    }

}
