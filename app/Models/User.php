<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
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
        'username',
        'name',
        'lastname',
        'email',
        'password',
        'code',
        'is_active',
        'is_admin'
    ];

    protected $guarded = [
        'password',
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
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_admin' => 'boolean'
    ];


    // RELATIONSHIPS
    function hearts(): HasMany
    {
        return $this->hasMany(Heart::class);
    }

    function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    function sender_conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'sender_id');
    }

    function receptor_conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'receptor_id');
    }

    function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    function friends(): HasMany
    {
        return $this->hasMany(Friend::class, 'sender_id');
    }

    function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    function teams_member(): BelongsToMany
    {
        return $this->belongsToMany(Team::class);
    }
}
