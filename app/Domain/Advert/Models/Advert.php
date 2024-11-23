<?php

namespace App\Domain\Advert\Models;

use MongoDB\Laravel\Eloquent\Model;

class Advert extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'adverts';
    protected $fillable = ['title', 'year', 'runtime', 'imdb', 'plot'];
}
