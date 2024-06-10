<?php

namespace Domain\Handbooks\Airports\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{

    protected $fillable = [
        'name'
    ];

    protected $casts = [
        'name' => 'string'
    ];

    protected string $resourceKey = 'aitports';

}
