<?php

namespace App\Domain\Movies\Repositories;

use App\Domain\Movies\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class GetEloquentMovie
{
    public function run(string $query = ''): Collection
    {
        return Movie::query()
                    ->where('movie', 'ilike', "%{$query}%")
                    ->orWhere('overview', 'ilike', "%{$query}%")
                    ->limit(20)
                    ->get();
    }
}
