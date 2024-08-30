<?php

namespace App\Domain\Patterns\AbstractFabric\Actions;
use App\Domain\Patterns\AbstractFabric\Abstracts\IronFactory;
use App\Domain\Patterns\AbstractFabric\Abstracts\WoodFactory;
use App\Domain\Patterns\AbstractFabric\Enums\DoorType;

class MakeDoorAction
{
    /**
     * @param DoorType $type
     * @return void
     */
    public function run(DoorType $type)
    {
        $door = match ($type) {
                    DoorType::iron => new IronFactory(),
                    DoorType::wood => new WoodFactory(),
                };

        $door->fabric()->make();
        $door->master()->collect();
    }
}
