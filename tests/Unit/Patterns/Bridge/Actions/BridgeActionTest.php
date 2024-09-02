<?php

namespace Tests\Unit\Patterns\Bridge\Actions;

use App\Domain\Patterns\Bridge\Actions\BridgeAction;
use PHPUnit\Framework\TestCase;

class BridgeActionTest extends TestCase
{

    public function test()
    {

        app(BridgeAction::class)->run();

    }

}
