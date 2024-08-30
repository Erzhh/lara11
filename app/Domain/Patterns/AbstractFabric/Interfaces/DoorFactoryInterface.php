<?php

namespace App\Domain\Patterns\AbstractFabric\Interfaces;
use App\Domain\Patterns\AbstractFabric\Enums\DoorType;

interface DoorFactoryInterface
{

    public function fabric():DoorBuilderFactoryInterface;
    public function master(): DoorMasterFactoryInterface;

}
