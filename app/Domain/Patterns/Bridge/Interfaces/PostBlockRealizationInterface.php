<?php

namespace App\Domain\Patterns\Bridge\Interfaces;

interface PostBlockRealizationInterface
{

    public function run(PostBlockInterface $block);

}
