<?php

namespace App\Domain\Patterns\AbstractFabric\Abstracts;

use App\Domain\Patterns\AbstractFabric\Interfaces\DoorBuilderFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Interfaces\DoorMasterFactoryInterface;
use App\Domain\Patterns\AbstractFabric\Realizations\IronDoorBuilderFactoryRealization;
use App\Domain\Patterns\AbstractFabric\Realizations\IronDoorMasterRealization;

class IronFactory implements DoorFactoryInterface
{
    public function fabric(): DoorBuilderFactoryInterface
    {
        return new IronDoorBuilderFactoryRealization();
    }

    public function master(): DoorMasterFactoryInterface
    {
        return new IronDoorMasterRealization();
    }
}
