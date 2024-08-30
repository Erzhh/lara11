<?php

namespace Domain\Patterns\Builder\Interfaces;

interface EditorInterface
{

    public function file(string $url, string $new_name = ''): EditorInterface;
    public function resize(int $w, int $h): EditorInterface;
    public function put(string $path, string $storage): EditorInterface;
    public function save(): string;

}
