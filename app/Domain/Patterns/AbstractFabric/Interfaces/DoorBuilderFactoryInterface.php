<?php

namespace App\Domain\Patterns\AbstractFabric\Interfaces;
use App\Domain\Patterns\AbstractFabric\Enums\DoorType;

interface DoorBuilderFactoryInterface
{

    public function make();

}
