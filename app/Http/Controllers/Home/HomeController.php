<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Services\Interfaces\UserInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * @param UserInterface $user
     *
     * @return void
     */
    public function __construct(private UserInterface $user)
    {
        //
    }


    /**
     * @param Request $request
     *
     * @return View
     */
    public function __invoke(Request $request): View
    {
        return view('pages.home', ['users' => $this->user->getAll()]);
    }
}
