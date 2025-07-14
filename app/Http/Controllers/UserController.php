<?php

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Models\User\UserId;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $user = User::fromRequest($request->all());
            $this->repository->create($user);

            return response()->json(['message' => 'User created successfully'], 201);

        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    public function getAll(): JsonResponse
    {
        $users = $this->repository->getAll();
        $userArray = array_map(fn(User $user) => $user->toArray(), $users);
        return response()->json($userArray);
    }

    public function getById($id): JsonResponse
    {
        try {
            $user = $this->repository->findById(UserId::fromInt($id));

            return $user
                ? response()->json($user->toArray())
                : response()->json(['error' => 'User not found'], 404);
        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $user = User::fromRequest(array_merge($request->all(), ['id' => $id]));
            $this->repository->update($user);

            return response()->json(['message' => 'User updated successfully']);

        } catch (ValidationException $e) {
            return response()->json($e->errors(), 422);
        }
    }

    public function delete(int $id): JsonResponse
    {
        $this->repository->delete(UserId::fromInt($id));
        return response()->json(['message' => 'User deleted successfully']);
    }
}
