<?php

namespace Tests\Unit\Patterns\Strategy\Actions;

use App\Domain\Patterns\Strategy\Strategies\CalculateRentOfficeManager;
use PHPUnit\Framework\TestCase;

class CalculateRentOfficeTest extends TestCase
{
    public function test()
    {

        app(CalculateRentOfficeManager::class)->run();

    }
}
