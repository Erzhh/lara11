<?php

namespace Domain\Handbooks\Airports\QueryBuilders;

use Core\Exceptions\QueryBuilderException;
use Domain\Handbooks\Airports\DTO\AirportFilterDTO;
use Domain\Handbooks\Airports\Repositories\AirportRepositoryRepositoryEloquent;

class GetListAirportByFilter {

    protected AirportRepositoryRepositoryEloquent $repository;

    public function __construct(AirportRepositoryRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function run(AirportFilterDTO $dto)
    {
        try {

            return $this->repository
                        ->getAirports()
                        ->filter(function ($value, $key) use($dto) {
                            return stripos($key, $dto->name) !== false;
                        });

        } catch (\Exception) {
            throw new QueryBuilderException();
        }
    }
}
