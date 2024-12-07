<?php

namespace API\Movies\Controllers;

use API\Movies\Requests\MovieCreateRequest;
use API\Movies\Requests\MovieDeleteRequest;
use API\Movies\Requests\MovieUpdateRequest;
use App\Domain\Movies\Tasks\CreateMovieByIdTask;
use App\Domain\Movies\Tasks\DeleteMovieByIdTask;
use App\Domain\Movies\Tasks\UpdateMovieByIdTask;
use Core\BaseController;
use Illuminate\Http\JsonResponse;

class MovieCRUDController extends BaseController
{
    public function update(MovieUpdateRequest $request): JsonResponse
    {
        $id = $request->id;
        $data = $request->getData();
        app(UpdateMovieByIdTask::class)->run($id,$data);

        return response()->json([],204);
    }

    public function create(MovieCreateRequest $request): JsonResponse
    {
        $data = $request->getData();
        $movie = app(CreateMovieByIdTask::class)->run($data);

        return response()->json(['movie' => $movie],201);
    }

    public function delete(MovieDeleteRequest $request): JsonResponse
    {
        $id = $request->getId();
        app(DeleteMovieByIdTask::class)->run($id);

        return response()->json([],204);
    }
}
