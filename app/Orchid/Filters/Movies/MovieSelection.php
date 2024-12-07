<?php
declare(strict_types=1);

namespace App\Orchid\Filters\Movies;

use Orchid\Screen\Layouts\Selection;

class MovieSelection extends Selection
{
    public function filters(): array
    {
        return [
            MovieTitleFilter::class,
            MovieElasticFilter::class
        ];
    }
}
