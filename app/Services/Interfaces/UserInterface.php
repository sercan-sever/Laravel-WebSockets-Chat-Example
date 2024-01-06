<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface
{

    /**
     * @param int|null $id
     *
     * @return User|null
     */
    public function getById(?int $id = null): ?User;


    /**
     * @return Collection
     */
    public function getAll(): Collection;


    /**
     * @param User|null $user
     *
     * @return bool
     */
    public function statusActiveChange(?User $user): bool;


    /**
     * @param User|null $user
     *
     * @return bool
     */
    public function statusPassiveChange(?User $user): bool;


    /**
     * @param User|null $user
     * @param string|null $password
     *
     * @return bool
     */
    public function updatePassword(?User $user, ?string $password = ""): bool;
}
