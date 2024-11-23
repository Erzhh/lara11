<?php

namespace App\Domain\Advert\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Advert extends Model
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $table = 'adverts';
    protected $fillable = ['title', 'year', 'runtime', 'imdb', 'plot'];
}
