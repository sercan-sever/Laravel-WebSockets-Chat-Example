<?php

namespace App\Listeners;

use App\Events\AuthLoggedIn;
use App\Services\Interfaces\UserInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserActiveStatus
{
    /**
     * Create the event listener.
     *
     * @param UserInterface $user
     *
     * @return void
     */
    public function __construct(public UserInterface $user)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AuthLoggedIn $event
     *
     * @return void
     */
    public function handle(AuthLoggedIn $event): void
    {
        $this->user->statusActiveChange(user: $event->user);
    }
}
