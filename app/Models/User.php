<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string|StatusEnum>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'status' => StatusEnum::class,
    ];


    /**
     * @return BelongsTo
     */
    public function avatar(): BelongsTo
    {
        return $this->belongsTo(Avatar::class, 'id', 'user_id')->withDefault();
    }


    /**
     * @return HasMany
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'id', 'sender_id')->orWhere('receiver_id', '=', 'id');
    }


    /**
     * @return HasMany
     */
    public function receiver(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id', 'id')->where('sender_id', auth()->id());
    }


    /**
     * @return HasMany
     */
    public function sender(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id', 'id')->where('receiver_id', auth()->id());
    }


    /**
     * @param StatusEnum $enum
     *
     * @return string
     */
    public function getStatusHtml(StatusEnum $enum = null): string
    {
        return StatusEnum::getStatusHtml($enum);
    }
}
