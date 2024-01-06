<?php

namespace App\Services\Interfaces;

use App\Models\Avatar;
use Illuminate\Http\UploadedFile;

interface AvatarInterface
{

    /**
     * @param int|null $userID
     *
     * @return Avatar|null
     */
    public function getByUserIdAvatar(?int $userID = null): ?Avatar;


    /**
     * @param int|null $userID
     * @param UploadedFile|null $image
     *
     * @return bool
     */
    public function createAvatar(?int $userID = null, ?UploadedFile $image = null): bool;


    /**
     * @param int|null $userID
     * @param UploadedFile|null $image
     *
     * @return bool
     */
    public function updateAvatar(?int $userID = null, ?UploadedFile $image = null): bool;
}
