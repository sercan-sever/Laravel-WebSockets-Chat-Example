<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    use HasFactory;


    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id', // Gönderen ID
        'receiver_id', // Alıcı ID
        'message', // Mesaj
    ];


    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id')->withDefault();
    }

    /**
     * @return string
     */
    public function getCreateHour(): string
    {
        $hour = Carbon::parse($this->created_at);

        return $hour->format("d-m-Y / H:i");
    }

    /**
     * @return string
     */
    public function getUpdateHour(): string
    {
        $hour = Carbon::parse($this->updated_at);

        return $hour->format("d-m-Y / H:i");
    }


    /**
     * @return bool
     */
    public function comparingUpdatedTimestamps(): bool
    {
        return $this->updated_at->gt($this->created_at);
    }
}
