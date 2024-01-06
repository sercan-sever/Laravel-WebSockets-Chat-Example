<?php

namespace App\Services\Repositories;

use App\Models\Avatar;
use App\Models\User;
use App\Services\Interfaces\AvatarInterface;
use App\Traits\ImageProcessingTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class AvatarRepository implements AvatarInterface
{
    use ImageProcessingTrait;


    /**
     * @param int|null $userID
     *
     * @return Avatar|null
     */
    public function getByUserIdAvatar(?int $userID = null): ?Avatar
    {
        $userID = is_null($userID) ? auth()->id() : $userID;

        return Avatar::query()->where('user_id', $userID)->first();
    }


    /**
     * @param int|null $userID
     * @param UploadedFile|null $image
     *
     * @return bool
     */
    public function createAvatar(?int $userID = null, ?UploadedFile $image = null): bool
    {
        $userID = (is_null($userID) || !is_int($userID)) ? auth()->id() : $userID;

        $file_ = $this->imageUpload($image, 'avatars', 400, 400);

        return (bool)Avatar::query()->create(
            [
                'user_id' => $userID,
                'image' => $file_['image'],
                'type' => $file_['type'],
            ]
        );
    }


    /**
     * @param int|null $userID
     * @param UploadedFile|null $image
     *
     * @return bool
     */
    public function updateAvatar(?int $userID = null, ?UploadedFile $image = null): bool
    {
        $avatar = $this->getByUserIdAvatar(userID: $userID);

        if (empty($avatar) || empty($image)) {

            Log::error("AvatarRepository ( updateAvatar )", ["Bir Kullanıcı Veya Görsel Bulunamadı !!!"]);

            return false;
        }

        $this->deleteImage(image: $avatar->image, path: 'avatars');

        $file_ = $this->imageUpload($image, 'avatars', 400, 400);

        return $avatar->update([
            'image' => $file_['image'],
            'type' => $file_['type'],
        ]);
    }
}
