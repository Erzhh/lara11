<?php

namespace Tests\Unit\Patterns\Delegation;

use App\Domain\Patterns\Delegation\Actions\SenderAction;
use PHPUnit\Framework\TestCase;

class SenderActionTest extends TestCase
{

    public function test()
    {

        app(SenderAction::class)->run();

    }

}
