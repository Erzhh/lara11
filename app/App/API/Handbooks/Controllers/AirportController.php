<?php

namespace API\Handbooks\Controllers;

use API\Handbooks\Requests\AirportListRequest;
use Domain\Handbooks\Airports\QueryBuilders\GetListAirportByFilter;
use Core\BaseController;

class AirportController extends BaseController
{

    /**
     * @param AirportListRequest $request
     * @return mixed
     */
    public function list(AirportListRequest $request)
    {
        $dto = $request->getData();

        $records = app(GetListAirportByFilter::class)->run($dto);

        return $records;
    }

}
