<?php

namespace App\Services\Interfaces;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface AuthenticateInterface
{

    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     *
     * @return bool
     */
    public function login(string $email = "", string $password = "", bool $remember = false): bool;


    /**
     * @param Request $request
     *
     * @return void
     */
    public function logout(Request $request): void;
}
