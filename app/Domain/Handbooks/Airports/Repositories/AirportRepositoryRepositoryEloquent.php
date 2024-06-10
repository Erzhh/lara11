<?php

namespace Domain\Handbooks\Airports\Repositories;

use Domain\Handbooks\Airports\Interfaces\AirportRepositoryRepository;
use Domain\Handbooks\Airports\Models\Airport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AirportRepositoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AirportRepositoryRepositoryEloquent extends BaseRepository implements AirportRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Airport::class;
    }

    public function getAirports(): Collection
    {
        return collect( Cache::get('airports', []) );
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
