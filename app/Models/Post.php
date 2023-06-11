<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'level_id',
        'receptor_type_id',
        'team_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    function images(): BelongsToMany
    {
        return $this->belongsToMany(Image::class);
    }

    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    public function receptorType(): BelongsTo
    {
        return $this->belongsTo(ReceptorType::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function hearts(): HasMany
    {
        return $this->hasMany(Heart::class);
    }
}
