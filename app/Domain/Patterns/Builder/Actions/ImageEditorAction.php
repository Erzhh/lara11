<?php

namespace App\Domain\Patterns\Builder\Actions;

class ImageEditorAction
{

    public function run()
    {

        app(ImageBuilder::class)
                ->file('http:file_url')
                ->resize(100, 100)
                ->put('files','public')
                ->save();

    }

}
