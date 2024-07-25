<?php

namespace API\Access\Users\Controllers;

use API\Access\Users\Requests\UserCreateRequest;
use API\Access\Users\Requests\UserUpdateRequest;
use App\Domain\Access\Users\Models\User;
use Core\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{

    protected EntityManagerInterface $repository;

    public function __construct(EntityManagerInterface $repository)
    {
        $this->repository = $repository;
    }

    public function find($id): JsonResponse
    {
        $userRepository = $this->repository->getRepository(User::class);
        $user = $userRepository->find($id);

        return response()->json(['user' => $user]);
    }

    public function list(): JsonResponse
    {
        $userRepository = $this->repository->getRepository(User::class);
        $users = $userRepository->findAll();

        return response()->json(['users' => $users ]);
    }

    public function store(UserCreateRequest $request): JsonResponse
    {
        $dto = $request->getData();

        $user = new User();
        $user->setName($dto->name);
        $user->setEmail($dto->email);
        $user->setPassword($dto->getHashPass());

        $this->repository->persist($user);
        $this->repository->flush();

        return response()->json(['user' => $user],201);
    }


    public function update(UserUpdateRequest $request, $id): JsonResponse
    {
        $dto = $request->getData();

        $userRepository = $this->repository->getRepository(User::class);
        $user = $userRepository->find($id);

        $user->setName($dto->name);

        $this->repository->flush();

        return response()->json([],204);
    }


    public function destroy($id): JsonResponse
    {
        $userRepository = $this->repository->getRepository(User::class);
        $user = $userRepository->find($id);

        $this->repository->remove($user);
        $this->repository->flush();

        return response()->json([],204);
    }


}
