<?php

namespace App\Services\Interfaces;

use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;

interface MessageInterface
{
    /**
     * @param int|nul $receiverID
     *
     * @return Collection
     */
    public function getChatMessage(?int $receiverID = null): Collection;


    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     *
     * @return ?Message
     */
    public function getISenderMessage(?int $messageID = null, ?int $receiverID = null): ?Message;


    /**
     * @param int|nul $receiverID
     * @param string|nul $message
     *
     * @return Message
     */
    public function create(?int $receiverID = null, ?string $message = ""): Message;


    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     * @param string $messageContent
     *
     * @return bool
     */
    public function update(?int $messageID, ?int $receiverID, string $messageContent): bool;


    /**
     * @param int|nul $messageID
     * @param int|nul $receiverID
     *
     * @return bool
     */
    public function delete(?int $messageID, ?int $receiverID): bool;
}
