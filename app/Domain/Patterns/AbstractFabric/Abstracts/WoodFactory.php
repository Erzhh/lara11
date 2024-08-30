<?php

namespace App\Domain\Patterns\AbstractFabric\Abstracts;

use App\Domain\Patterns\AbstractFabric\Interfaces\DoorBuilderFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorMasterFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Realizations\WoodDoorBuilderFactoryRealization;
use App\Domain\Patterns\AbstractFabric\Realizations\WoodDoorMasterRealization;

class WoodFactory implements DoorFactoryInterface
{
    public function fabric(): DoorBuilderFactoryInterface
    {
        return new WoodDoorBuilderFactoryRealization();
    }

    public function master(): DoorMasterFactoryInterface
    {
        return new WoodDoorMasterRealization();
    }
}
