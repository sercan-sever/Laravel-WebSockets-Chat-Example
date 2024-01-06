<?php

namespace App\Services\Repositories;

use App\Models\Message;
use App\Services\Interfaces\MessageInterface;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository implements MessageInterface
{

    /**
     * @param int|nul $receiverID
     *
     * @return Collection
     */
    public function getChatMessage(?int $receiverID = null): Collection
    {
        return Message::query()->with('sender')->where(
            function ($query) use ($receiverID) {
                $query->where(function ($q) use ($receiverID) {
                    $q->where('sender_id', $receiverID)
                        ->where('receiver_id', auth()->id());
                })->orWhere(function ($q) use ($receiverID) {
                    $q->where('sender_id', auth()->id())
                        ->where('receiver_id', $receiverID);
                });
            }
        )->get();
    }


    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     *
     * @return ?Message
     */
    public function getISenderMessage(?int $messageID = null, ?int $receiverID = null): ?Message
    {
        return Message::query()->with('receiver')
            ->where('sender_id', auth()->id())
            ->where('receiver_id', $receiverID)->find($messageID);
    }


    /**
     * @param int|nul $receiverID
     * @param string|nul $message
     *
     * @return Message
     */
    public function create(?int $receiverID = null, ?string $message = ""): Message
    {
        return Message::query()->create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverID,
            'message' => $message,
        ]);
    }


    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     * @param string $messageContent
     *
     * @return bool
     */
    public function update(?int $messageID, ?int $receiverID, string $messageContent): bool
    {
        $message = $this->getISenderMessage(
            messageID: $messageID,
            receiverID: $receiverID
        );

        if (!empty($message)) {

            return $message->update([
                'message' => $messageContent
            ]);
        }

        return false;
    }

    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     *
     * @return bool
     */
    public function delete(?int $messageID, ?int $receiverID): bool
    {
        $message = $this->getISenderMessage(
            messageID: $messageID,
            receiverID: $receiverID
        );

        if (!empty($message)) {

            return $message->delete();
        }

        return false;
    }
}
