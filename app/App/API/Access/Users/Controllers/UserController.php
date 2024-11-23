<?php

namespace API\Access\Users\Controllers;

use API\Access\Users\Requests\UserCreateRequest;
use API\Access\Users\Requests\UserUpdateRequest;
use App\Domain\Access\Users\Models\User;
use Core\BaseController;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    public function find($id): JsonResponse
    {
        $record = User::query()->find($id);

        return response()->json(['user' => $record]);
    }

    public function list(): JsonResponse
    {
        $records = User::query()->get();

        return response()->json(['users' => $records ]);
    }

    public function paginate(int $page, int $limit): JsonResponse
    {
        $records = User::query()->paginate();

        return response()->json(['users' => $records ]);
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        $dto = $request->getData();

        $user = new User();
        $user->fill($dto->toArray());
        $user->save();

        return response()->json(['user' => $user],201);
    }

    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $dto = $request->getData();

        $user = User::query()->findOrFail($id);
        $user->setName($dto->name);
        $user->save();

        return response()->json([],204);
    }

    public function destroy($id): JsonResponse
    {
        $user = User::query()->find($id)->delete();

        return response()->json([],204);
    }
}
