<?php

namespace App\Domain\Patterns\AbstractFabric\Realizations;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorMasterFactoryInterface;

class WoodDoorMasterRealization implements DoorMasterFactoryInterface
{

    public function collect(): void
    {
        ray('i do wood door');
    }

}
