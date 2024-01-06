<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use App\Http\Requests\UpdatePasswordRequest;
use App\Services\Interfaces\AvatarInterface;
use App\Services\Interfaces\UserInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @param AvatarInterface $avatar
     * @param UserInterface $user
     *
     * @return void
     */
    public function __construct(private AvatarInterface $avatar, private UserInterface $user)
    {
        //
    }


    /**
     * @return View
     */
    public function index(): View
    {
        return view('pages.settings');
    }


    /**
     * @param UpdateAvatarRequest $request
     *
     * @return JsonResponse
     */
    public function updateAvatar(UpdateAvatarRequest $request): JsonResponse
    {
        $result = $this->avatar->updateAvatar(image: $request->validated('avatar'));

        return response()->json(['success' => $result]);
    }


    /**
     * @param UpdateAvatarRequest $request
     *
     * @return RedirectResponse|JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): RedirectResponse|JsonResponse
    {
        $user = $this->user->getById(id: auth()->id());

        $result = $this->user->updatePassword(user: $user, password: passwordGeneration(password: $request->validated('password')));

        return response()->json(['success' => $result]);
    }
}
