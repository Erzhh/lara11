<?php

namespace Tests\Unit\Patterns\Singleton\Actions;

use App\Domain\Patterns\Singleton\Actions\SomeCalculationAction;
use PHPUnit\Framework\TestCase;

class SomeCalculationActionTest extends TestCase
{
    public function test()
    {

        app(SomeCalculationAction::class)->run();

    }
}
