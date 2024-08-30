<?php

namespace Domain\Patterns\Builder\Interfaces;

interface ImageEditorInterface extends EditorInterface
{

    public function effect(int $reverse = 0, int $blur = 0, int $border = 0):ImageEditorInterface;

}
