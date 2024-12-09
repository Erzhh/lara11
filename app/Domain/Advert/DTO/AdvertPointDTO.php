<?php

namespace App\Domain\Advert\DTO;

use Spatie\LaravelData\Data;

class AdvertPointDTO extends Data
{
    public string $lat;
    public string $lon;
}
