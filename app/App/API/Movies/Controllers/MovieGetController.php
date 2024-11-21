<?php

namespace API\Movies\Controllers;

use API\Movies\Requests\MovieRequest;
use App\Domain\Movies\Repositories\GetElasticMovie;
use App\Domain\Movies\Repositories\GetEloquentMovie;
use Core\BaseController;
use Illuminate\Http\JsonResponse;

class MovieGetController extends BaseController
{
    public function list(MovieRequest $request): JsonResponse
    {
        $search = $request->getQuery();
        $result = app(GetEloquentMovie::class)->run($search);

        return response()->json(['movies' => $result]);
    }

    public function elastic(MovieRequest $request)
    {
        $search = $request->getQuery();
        $result = app(GetElasticMovie::class)->run($search);

        return response()->json(['movies' => $result]);
    }
}
