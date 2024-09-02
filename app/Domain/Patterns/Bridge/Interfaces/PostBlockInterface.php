<?php

namespace App\Domain\Patterns\Bridge\Interfaces;

interface PostBlockInterface
{

    public function getTitle():string;
    public function getDescription():string;
    public function getImage():string;

}
