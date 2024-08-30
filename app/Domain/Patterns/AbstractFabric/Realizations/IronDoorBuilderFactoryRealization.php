<?php

namespace App\Domain\Patterns\AbstractFabric\Realizations;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorBuilderFactoryInterface;

class IronDoorBuilderFactoryRealization implements DoorBuilderFactoryInterface
{
    public function make()
    {
        ray('build iron door');
    }
}
