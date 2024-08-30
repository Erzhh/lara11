<?php

namespace App\Domain\Patterns\Builder\Actions;
use Domain\Patterns\Builder\Interfaces\EditorInterface;
use Domain\Patterns\Builder\Interfaces\ImageEditorInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ImageBuilder implements ImageEditorInterface
{
    private string $file_name;
    public function __construct()
    {
        $this->file_name = Str::random('32');
    }

    public function file(string $url, string $new_name = ''): EditorInterface
    {
        if ( !empty($new_name) )
        {
            $this->file_name = $new_name;
        }
        Log::info("file:$url, name:$new_name");

        return $this;
    }

    public function resize(int $w, int $h): EditorInterface
    {
        Log::info("w:$w, h:$h");
        return $this;
    }

    public function put(string $path, string $storage): EditorInterface
    {
        Log::info("put:$path, storage:$storage");
        return $this;
    }

    public function save(): string
    {
        Log::info("save");
        return $this->file_name;
    }

    public function effect(int $reverse = 0, int $blur = 0, int $border = 0): ImageEditorInterface
    {
        Log::info("reverse:$reverse, blur:$blur, border:$border");
        return $this;
    }

}
