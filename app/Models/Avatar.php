<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avatar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'image',
        'type'
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }


    /**
     * @return string
     */
    public function getAvatar(): string
    {
        return (!empty($this->image) && file_exists(public_path('images/avatars/' . $this->image)))
            ? asset('images/avatars/' . $this->image)
            : asset('default/avatar.png');
    }
}
