<?php

namespace Tests\Unit\Patterns\AbstractFabric\Actions;

use App\Domain\Patterns\AbstractFabric\Actions\MakeDoorAction;
use App\Domain\Patterns\AbstractFabric\Enums\DoorType;
use PHPUnit\Framework\TestCase;

class MakeDoorActionTest extends TestCase
{

    public function test()
    {

        app(MakeDoorAction::class)->run(DoorType::wood);
        app(MakeDoorAction::class)->run(DoorType::iron);

    }

}
