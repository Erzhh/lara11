<?php

namespace App\Domain\Patterns\Bridge\Abstracts;

use App\Domain\Patterns\Bridge\Interfaces\PostBlockInterface;
use App\Domain\Patterns\Bridge\Interfaces\PostBlockRealizationInterface;

abstract class PostWallerAbstract implements PostBlockRealizationInterface
{

    /**
     * @param PostBlockInterface $block
     * @return array
     */
    public function run(PostBlockInterface $block)
    {
        $data = [
                'title' => $block->getTitle(),
                'description' => $block->getDescription(),
                'image' => $block->getImage(),
        ];

        return $data;
    }
}
