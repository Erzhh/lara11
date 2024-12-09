<?php
namespace Database\Factories;

use App\Domain\Advert\Models\Advert;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdvertFactory extends Factory
{
    protected $model = Advert::class;

    public function definition(): array
    {
        return [
            'title'    => $this->faker->sentence(3),
            'price'    => $this->faker->randomFloat(2, 100, 10000),
            'room'     => $this->faker->biasedNumberBetween(1,5),
            'level'    => $this->faker->biasedNumberBetween(0,9),
            'location' => [
                'lat' => $this->faker->latitude(43.224837, 43.398706),
                'lon' => $this->faker->longitude(76.87585440695501, 76.95070407813036),
            ]
        ];
    }
}
