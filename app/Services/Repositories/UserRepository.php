<?php

namespace App\Services\Repositories;

use App\Enums\StatusEnum;
use App\Models\User;
use App\Services\Interfaces\UserInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{

    /**
     * @param int|null $id
     *
     * @return User|null
     */
    public function getById(?int $id = null): ?User
    {
        return User::query()->find($id);
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return User::query()->select(['id', 'name', 'email', 'status'])->get();
    }


    /**
     * @param User|null $user
     *
     * @return bool
     */
    public function statusActiveChange(?User $user): bool
    {
        return $user->update(['status' => StatusEnum::ACTIVE]);
    }


    /**
     * @param User|null $user
     *
     * @return bool
     */
    public function statusPassiveChange(?User $user): bool
    {
        return $user->update(['status' => StatusEnum::PASSIVE]);
    }


    /**
     * @param User|null $user
     * @param string|null $password
     *
     * @return bool
     */
    public function updatePassword(?User $user, ?string $password = ""): bool
    {
        return $user->update(['password' => Hash::make($password)]);
    }
}
