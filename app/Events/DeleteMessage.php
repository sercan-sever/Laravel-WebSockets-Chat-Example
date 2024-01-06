<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Message $chat
     *
     * @return void
     */
    public function __construct(public Message $chat)
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
            new PrivateChannel('sender-delete-message.' . $this->chat->receiver_id),
            new PrivateChannel('receiver-delete-message.' . $this->chat->sender_id),
        ];
    }


    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return "DeleteMessage";
    }


    /**
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id'              => $this->chat->id,
            'sender'          => $this->chat->sender_id,
            'receiver'        => $this->chat->receiver_id,
        ];
    }
}
