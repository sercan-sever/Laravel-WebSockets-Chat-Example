<?php

namespace App\Services\Repositories;

use App\Events\AuthLoggedIn;
use App\Events\AuthLoggedOut;
use App\Services\Interfaces\AuthenticateInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateRepository implements AuthenticateInterface
{

    /**
     * @var bool
     */
    private bool $result = false;


    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     *
     * @return bool
     */
    public function login(string $email = "", string $password = "", bool $remember = false): bool
    {
        if (Auth::attempt(credentials: ['email' => $email, 'password' => passwordGeneration(password: $password)], remember: $remember)) {
            request()->session()->regenerate();

            event(new AuthLoggedIn(user: auth()->user()));

            $this->result = true;
        }

        return $this->result;
    }


    /**
     * @param Request $request
     *
     * @return void
     */
    public function logout(Request $request): void
    {
        event(new AuthLoggedOut(user: auth()->user()));

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
}
