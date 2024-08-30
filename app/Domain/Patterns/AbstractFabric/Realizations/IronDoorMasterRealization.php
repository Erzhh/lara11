<?php

namespace App\Domain\Patterns\AbstractFabric\Realizations;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorMasterFactoryInterface;

class IronDoorMasterRealization implements DoorMasterFactoryInterface
{

    public function collect(): void
    {
        ray('i do iron door');
    }

}
