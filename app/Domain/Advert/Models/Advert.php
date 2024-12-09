<?php
declare(strict_types=1);

namespace App\Domain\Advert\Models;

use App\Support\Traits\Searchable;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Advert extends Model
{
    use Searchable;
    use SoftDeletes;
    use AsSource, Filterable;

    protected $connection = 'mongodb';

    protected $table = 'adverts';
    protected $fillable = [
        'title',
        'price',
        'room',
        'level',
        'location',
    ];
}
