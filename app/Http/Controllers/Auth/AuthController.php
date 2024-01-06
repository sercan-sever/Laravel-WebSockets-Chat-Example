<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Services\Interfaces\AuthenticateInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    /**
     * @param AuthenticateInterface $auth
     *
     * @return void
     */
    public function __construct(private AuthenticateInterface $authenticate)
    {
        //
    }


    /**
     * @return View
     */
    public function loginPage(): View
    {
        return view('layouts.login');
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function login(AuthLoginRequest $request): RedirectResponse
    {
        $result = $this->authenticate->login(
            email: $request->validated('email'),
            password: $request->validated('password'),
            remember: $request->has('remember')
        );

        return $result ?
            redirect()->intended('chat-app') :
            back()->with([
                'alert-error-toast' => 'Bilgileriniz Kayıtlarımız İle Eşleşmiyor.',
            ]);
    }


    /**
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $this->authenticate->logout(request: $request);

        return redirect()->route('login.page');
    }
}
