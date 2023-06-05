<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_birth',
        'gender',
        'country_id',
        'image',
        'image_header',
        'title',
        'bio',
        'likes',
        'dislikes',
        'address',
        'phone',
        'public_email',
        'user_id',
        'level_id',
        'sentimental_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function sentimental()
    {
        return $this->belongsTo(Sentimental::class);
    }
}
