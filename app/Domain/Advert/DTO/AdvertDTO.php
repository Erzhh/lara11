<?php
declare(strict_types=1);

namespace Domain\Advert\DTO;

use App\Domain\Advert\DTO\AdvertPointDTO;
use Spatie\LaravelData\Data;

class AdvertDTO extends Data
{
    public string $title;
    public float $price;
    public string $room;
    public string $level;
    public AdvertPointDTO $location;

    public function toArray(): array
    {
        return [
            'title'    => $this->title,
            'price'    => $this->price,
            'room'     => $this->room,
            'level'    => $this->level,
            'location' => $this->location->toArray(),
        ];
    }
}
