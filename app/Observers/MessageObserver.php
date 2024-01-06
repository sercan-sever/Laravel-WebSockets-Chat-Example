<?php

namespace App\Observers;

use App\Events\DeleteMessage;
use App\Events\SendMessage;
use App\Events\UpdateMessage;
use App\Models\Message;

class MessageObserver
{
    /**
     * Handle the Message "created" event.
     */
    public function created(Message $message): void
    {
        event(new SendMessage(chat: $message));
    }

    /**
     * Handle the Message "updated" event.
     */
    public function updated(Message $message): void
    {
        event(new UpdateMessage(chat: $message));
    }

    /**
     * Handle the Message "deleting" event.
     */
    public function deleting(Message $message): void
    {
        event(new DeleteMessage(chat: $message));
    }

    /**
     * Handle the Message "deleted" event.
     */
    public function deleted(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "restored" event.
     */
    public function restored(Message $message): void
    {
        //
    }

    /**
     * Handle the Message "force deleted" event.
     */
    public function forceDeleted(Message $message): void
    {
        //
    }
}
