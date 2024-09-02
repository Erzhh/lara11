<?php

namespace App\Domain\Patterns\Bridge\Abstracts;

use App\Domain\Patterns\Bridge\Interfaces\PostBlockInterface;
use App\Domain\Patterns\Bridge\Models\Product;

class ProductPostAbstract implements PostBlockInterface
{

    public function __construct(public Product $product)
    {}

    public function getTitle(): string
    {
        return $this->product->name;
    }

    public function getDescription(): string
    {
        return $this->product->description;
    }

    public function getImage(): string
    {
        return '';
    }

}
