<?php

namespace App\Events;

use App\Enums\StatusEnum;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AuthLoggedIn implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param User $user
     *
     * @return void
     */
    public function __construct(public User $user)
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
            new Channel('user-active'),
        ];
    }


    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return "UserActive";
    }


    /**
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id'     => $this->user->id,
            'name'   => $this->user->name,
            'email'  => $this->user->email,
            'status' => $this->user->getStatusHtml(enum: $this->user->isDirty('status') ? $this->user->status : StatusEnum::ACTIVE),
        ];
    }
}
