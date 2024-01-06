<?php

namespace App\Observers;

use App\Events\UpdateAvatar;
use App\Models\Avatar;

class AvatarObserver
{
    /**
     * Handle the Avatar "created" event.
     */
    public function created(Avatar $avatar): void
    {
        //
    }

    /**
     * Handle the Avatar "updated" event.
     */
    public function updated(Avatar $avatar): void
    {
        event(new UpdateAvatar(avatar:  $avatar));
    }

    /**
     * Handle the Avatar "deleted" event.
     */
    public function deleted(Avatar $avatar): void
    {
        //
    }

    /**
     * Handle the Avatar "restored" event.
     */
    public function restored(Avatar $avatar): void
    {
        //
    }

    /**
     * Handle the Avatar "force deleted" event.
     */
    public function forceDeleted(Avatar $avatar): void
    {
        //
    }
}
