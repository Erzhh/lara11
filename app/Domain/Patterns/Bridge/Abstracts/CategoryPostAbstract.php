<?php

namespace App\Domain\Patterns\Bridge\Abstracts;

use App\Domain\Patterns\Bridge\Interfaces\PostBlockInterface;
use App\Domain\Patterns\Bridge\Models\Category;

class CategoryPostAbstract implements PostBlockInterface
{

    public function __construct(public Category $category)
    {}

    public function getTitle(): string
    {
        return $this->category->title;
    }

    public function getDescription(): string
    {
        return $this->category->description;
    }

    public function getImage(): string
    {
        return $this->category->image;
    }

}
