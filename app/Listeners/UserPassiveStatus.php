<?php

namespace App\Listeners;

use App\Events\AuthLoggedOut;
use App\Services\Interfaces\UserInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserPassiveStatus
{
    /**
     * Create the event listener.
     *
     * @param UserInterface $userProcesses
     *
     * @return void
     */
    public function __construct(public UserInterface $userProcesses)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param AuthLoggedOut $event
     *
     * @return void
     */
    public function handle(AuthLoggedOut $event): void
    {
        $this->userProcesses->statusPassiveChange(user: $event->user);
    }
}
