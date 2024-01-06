<?php

namespace App\Events;

use App\Models\Avatar;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateAvatar implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Avatar $avatar
     *
     * @return void
     */
    public function __construct(public Avatar $avatar)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('update-avatar'),
        ];
    }


    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return "UpdateAvatar";
    }


    /**
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id'     => $this->avatar->id,
            'user'   => $this->avatar->user_id,
            'avatar' => $this->avatar?->getAvatar()
        ];
    }
}
