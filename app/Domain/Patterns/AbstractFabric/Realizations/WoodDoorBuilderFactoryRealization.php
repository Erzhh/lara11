<?php

namespace App\Domain\Patterns\AbstractFabric\Realizations;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorBuilderFactoryInterface;

class WoodDoorBuilderFactoryRealization implements DoorBuilderFactoryInterface
{
    public function make()
    {
        ray('build wood door');
    }
}
