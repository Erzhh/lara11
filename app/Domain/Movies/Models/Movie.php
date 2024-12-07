<?php

namespace App\Domain\Movies\Models;

use App\Support\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Screen\AsSource;

class Movie extends Model
{
    use Searchable;
    use AsSource, Filterable;

    protected $fillable = [
        'movie',
        'year',
        'country',
        'rating_ball',
        'overview',
        'director',
        'screenwriter',
        'actors',
        'url_logo'
    ];

    public $timestamps = false;

    protected $allowedFilters = [
        'movie'       => Where::class,
    ];

}
