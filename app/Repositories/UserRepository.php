<?php

namespace App\Repositories;

use App\Models\User\User;
use App\Models\User\UserId;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserRepository
{
    public function create(User $user): void
    {
        DB::statement('CALL create_user(?, ?, ?)', [
            $user->getFirstName()->asString(),
            $user->getLastName()->asString(),
            $user->getEmail()->asString(),
        ]);
    }

    public function update(User $user): void
    {
        DB::statement('CALL update_user(?, ?, ?, ?)', [
            $user->getId()->asInt(),
            $user->getFirstName()->asString(),
            $user->getLastName()->asString(),
            $user->getEmail()->asString(),
        ]);
    }

    public function delete(UserId $id): void
    {
        DB::statement('CALL delete_user(?)', [$id->asInt()]);
    }

    /**
     * @throws ValidationException
     */
    public function findById(UserId $id): ?User
    {
        $result = DB::selectOne('CALL get_user_by_id(?)', [$id->asInt()]);
        return $result ? User::fromArray((array)$result) : null;
    }

    /**
     * @return User[]
     * @throws ValidationException
     */
    public function getAll(): array
    {
        $results = DB::select('CALL get_all_users()');
        return array_map(function ($row) {
            return User::fromArray((array) $row);
        }, $results);
    }

}
