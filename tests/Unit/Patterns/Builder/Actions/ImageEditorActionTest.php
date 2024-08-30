<?php

namespace Tests\Unit\Patterns\Builder\Actions;

use App\Domain\Patterns\Builder\Actions\ImageEditorAction;
use Tests\TestCase;
class ImageEditorActionTest extends TestCase
{

    public function test()
    {

        app(ImageEditorAction::class)->run();

    }
}
