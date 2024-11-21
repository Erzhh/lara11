<?php

namespace App\Domain\Movies\Models;

use App\Support\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'rating',
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
}
